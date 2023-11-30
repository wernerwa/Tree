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

require_once 'tree.php';
require_once 'visitor.php';

/**
 * @package Tree
 * @subpackage Tests
 */
class ezcTreeVisitorYUITest extends ezcTreeVisitorTest
{
    public function testBrokenXmlId()
    {
        try
        {
            $visitor = new ezcTreeVisitorYUI( 42 );
            self::fail( 'Expected exception not thrown.' );
        }
        catch ( ezcBaseValueException $e )
        {
            self::assertSame( "The value '42' that you were trying to assign to setting 'xmlId' is invalid. Allowed values are: non-empty string.", $e->getMessage() );
        }
    }

    public function testEmptyXmlId()
    {
        try
        {
            $visitor = new ezcTreeVisitorYUI( '' );
            self::fail( 'Expected exception not thrown.' );
        }
        catch ( ezcBaseValueException $e )
        {
            self::assertSame( "The value '' that you were trying to assign to setting 'xmlId' is invalid. Allowed values are: non-empty string.", $e->getMessage() );
        }
    }

    public function testVisitorYUIDefault()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorYUI( 'productsandservices' );
        $tree->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-default.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorYUIDisplayRootNode()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorYUI( 'productsandservices' );
        $visitor->options->displayRootNode = true;

        $tree->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-display-root-node.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorYUISelectedNodeLink1()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorYUI( 'productsandservices' );
        $visitor->options->selectedNodeLink = true;

        $tree->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-selected-node-link.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorYUISelectedNodeLink2()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorYUI( 'productsandservices' );
        $visitor->options->displayRootNode = true;
        $visitor->options->selectedNodeLink = true;

        $tree->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-selected-node-link2.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorYUISelectedNodeLink3()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorYUI( 'productsandservices' );
        $visitor->options->displayRootNode = true;
        $visitor->options->selectedNodeLink = true;
        $visitor->options->basePath = 'testing';

        $tree->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-selected-node-link3.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorYUIXmlId()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $visitor = new ezcTreeVisitorYUI( 'productsandservices' );

        $tree->fetchNodeById( 'Hylobatidae' )->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-xml-id.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public function testVisitorYUIHighlightNodes()
    {
        $tree = ezcTreeMemory::create( new ezcTreeMemoryDataStore() );
        $this->addTestData( $tree );

        $options = new ezcTreeVisitorYUIOptions;
        $options->highlightNodeIds = array( 'Nomascus', 'Eastern Black Crested Gibbon', 'Hoolock' );
        $visitor = new ezcTreeVisitorYUI( 'monkeys', $options );

        $tree->fetchNodeById( 'Hylobatidae' )->accept( $visitor );
        $expected = file_get_contents( dirname( __FILE__) . '/files/compare/yui-highlight-nodes.txt' );
        self::assertSame( $expected, $visitor->__toString() );
    }

    public static function suite()
    {
         return new PHPUnit_Framework_TestSuite( "ezcTreeVisitorYUITest" );
    }
}

?>
