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

require_once 'files/test_classes.php';

/**
 * @package Tree
 * @subpackage Tests
 */
class ezcTreeNodeListIteratorTest extends ezcTestCase
{
    public function setUp()
    {
        $this->tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
    }

    public function testEmptyList()
    {
        $list = new ezcTreeNodeList;

        foreach ( new ezcTreeNodeListIterator( $this->tree, $list ) as $key => $node )
        {
            self::fail( "The list is not empty." );
        }
    }

    public function testEmptyListPreFetch()
    {
        $list = new ezcTreeNodeList;

        foreach ( new ezcTreeNodeListIterator( $this->tree, $list, true ) as $key => $node )
        {
            self::fail( "The list is not empty." );
        }
    }

    public function testOneItem()
    {
        $list = new ezcTreeNodeList;

        $node = new ezcTreeNode( $this->tree, '9' );
        $node->data = 'negen';
        $list->addNode( $node );

        foreach ( new ezcTreeNodeListIterator( $this->tree, $list ) as $key => $data )
        {
            self::assertSame( 9, $key );
            self::assertSame( 'negen', $data );
        }
    }

    public function testMoreItems()
    {
        $list = new ezcTreeNodeList;

        $node = new ezcTreeNode( $this->tree, '23' );
        $node->data = 'drieentwintig';
        $list->addNode( $node );

        $node = new ezcTreeNode( $this->tree, '29' );
        $node->data = 'negenentwintig';
        $list->addNode( $node );

        $node = new ezcTreeNode( $this->tree, '31' );
        $node->data = 'eenendertig';
        $list->addNode( $node );

        foreach ( new ezcTreeNodeListIterator( $this->tree, $list ) as $key => $data )
        {
        }
        self::assertSame( 31, $key );
        self::assertSame( 'eenendertig', $data );
    }

    public function testMoreItemsNonNumericKey()
    {
        $list = new ezcTreeNodeList;

        $node = new ezcTreeNode( $this->tree, 'boom' );
        $node->data = 'tree';
        $list->addNode( $node );

        $node = new ezcTreeNode( $this->tree, 'roos' );
        $node->data = 'rose';
        $list->addNode( $node );

        $node = new ezcTreeNode( $this->tree, 'vis' );
        $node->data = 'fish';
        $list->addNode( $node );

        foreach ( new ezcTreeNodeListIterator( $this->tree, $list ) as $key => $data )
        {
        }
        self::assertSame( 'vis', $key );
        self::assertSame( 'fish', $data );
    }

    public function testOnDemandData()
    {
        $tree = ezcTreeMemory::create( new TestTranslateDataStore() );
        $list = new ezcTreeNodeList;

        $node = new ezcTreeNode( $tree, 'vuur' );
        $list->addNode( $node );

        foreach ( new ezcTreeNodeListIterator( $tree, $list ) as $key => $data )
        {
            self::assertSame( 'vuur', $key );
            self::assertSame( array( 'en' => 'fire', 'de' => 'feuer', 'no' => 'fyr' ), $data );
        }
    }

    public static function suite()
    {
         return new PHPUnit_Framework_TestSuite( "ezcTreeNodeListIteratorTest" );
    }
}

?>
