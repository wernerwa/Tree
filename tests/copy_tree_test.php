<?php
/**
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @version //autogentag//
 * @filesource
 * @package Tree
 * @subpackage Tests
 */

/**
 * @package Tree
 * @subpackage Tests
 */
class ezcTreeCopyTest extends ezcTestCase
{
    protected function setUp()
    {
        static $i = 0;

        $this->tempDir = $this->createTempDir( __CLASS__ . sprintf( '_%03d_', ++$i ) ) . '/';
        $this->storeFromXml = new ezcTreeXmlInternalDataStore();
        $this->storeFromMem = new ezcTreeMemoryDataStore();
        $this->storeToXml = new ezcTreeXmlInternalDataStore();
        $this->storeToMem = new ezcTreeMemoryDataStore();
    }

    protected function tearDown()
    {
        $this->removeTempDir();
    }

    protected function addTestData( $tree )
    {
        $primates = array(
            'Hominoidea' => array(
                'Hylobatidae' => array(
                    'Hylobates' => array(
                        'Lar Gibbon',
                        'Agile Gibbon',
                        'Müller\'s Bornean Gibbon',
                        'Silvery Gibbon',
                        'Pileated Gibbon',
                        'Kloss\'s Gibbon',
                    ),
                    'Hoolock' => array(
                        'Western Hoolock Gibbon',
                        'Eastern Hoolock Gibbon',
                    ),
                    'Symphalangus' => array(),
                    'Nomascus' => array(
                        'Black Crested Gibbon',
                        'Eastern Black Crested Gibbon',
                        'White-cheecked Crested Gibbon',
                        'Yellow-cheecked Gibbon',
                    ),
                ),
                'Hominidae' => array(
                    'Pongo' => array(
                        'Bornean Orangutan',
                        'Sumatran Orangutan',
                    ),
                    'Gorilla' => array(
                        'Western Gorilla' => array(
                            'Western Lowland Gorilla',
                            'Cross River Gorilla',
                        ),
                        'Eastern Gorilla' => array(
                            'Mountain Gorilla',
                            'Eastern Lowland Gorilla',
                        ),
                    ),
                    'Homo' => array(
                        'Homo Sapiens' => array(
                            'Homo Sapiens Sapiens',
                            'Homo Superior'
                        ),
                    ),
                    'Pan' => array(
                        'Common Chimpanzee',
                        'Bonobo',
                    ),
                ),
            ),
        );

        $root = $tree->createNode( 'Hominoidea', 'Hominoidea' );
        $tree->setRootNode( $root );

        $this->addChildren( $root, $primates['Hominoidea'] );
    }

    private function addChildren( ezcTreeNode $node, array $children )
    {
        foreach( $children as $name => $child )
        {
            if ( is_array( $child ) )
            {
                $newNode = $node->tree->createNode( $name, $name );
                $node->addChild( $newNode );
                $this->addChildren( $newNode, $child );
            }
            else
            {
                $newNode = $node->tree->createNode( $child, $child );
                $node->addChild( $newNode );
            }
        }
    }

    protected function doCopyTest( $treeFrom, $treeTo )
    {
        ezcTree::copy( $treeFrom, $treeTo );

        self::assertSame( 35, $treeFrom->getChildCountRecursive( 'Hominoidea' ) );
        self::assertSame( 35, $treeTo->getChildCountRecursive( 'Hominoidea' ) );

        $pathFrom = $treeFrom->fetchPath( 'Homo Superior' );
        $pathTo   = $treeTo->fetchPath( 'Homo Superior' );
        self::assertEquals( 5, $pathFrom->size );
        self::assertEquals( 5, $pathTo->size );
        self::assertSame( array_keys( $pathFrom->nodes ), array_keys( $pathTo->nodes ) );

        $node = $treeFrom->fetchNodeById( 'Müller\'s Bornean Gibbon' );
        self::assertSame( "Müller's Bornean Gibbon", $node->data );

        $node = $treeTo->fetchNodeById( 'Müller\'s Bornean Gibbon' );
        self::assertSame( "Müller's Bornean Gibbon", $node->data );
    }

    public function testTreeMemoryToXML()
    {
        $treeFrom = ezcTreeMemory::create( $this->storeFromMem );
        $this->addTestData( $treeFrom );
        $treeTo = ezcTreeXml::create( $this->tempDir . 'testTreeMemoryToXML.xml', $this->storeToXml );
        self::doCopyTest( $treeFrom, $treeTo );
    }

    public function testTreeXmlToMemory()
    {
        $treeFrom = ezcTreeXml::create( $this->tempDir . 'testTreeMemoryToXML.xml', $this->storeFromXml );
        $this->addTestData( $treeFrom );
        $treeTo = ezcTreeMemory::create( $this->storeToMem );
        self::doCopyTest( $treeFrom, $treeTo );
    }

    public static function suite()
    {
         return new PHPUnit_Framework_TestSuite( "ezcTreeCopyTest" );
    }
}

?>
