<?php
/**
 * File containing the ezcTreeXmlInternalDataStore class.
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
 */

/**
 * ezcTreeXmlInternalDataStore is an implementation of a tree node data store
 * that stores node information in child elements of the XML elements
 * containing the tree nodes.
 *
 * @package Tree
 * @version //autogentag//
 */
class ezcTreeXmlInternalDataStore implements ezcTreeXmlDataStore
{
    /**
     * Contains the DOM representing this tree this data store stores data for.
     *
     * @var DOMDocument
     */
    protected $dom;

    /**
     * Associates the DOM tree for which this data store stores data for with
     * this store.
     *
     * @param DOMDocument $dom
     */
    public function setDomTree( DOMDocument $dom )
    {
        $this->dom = $dom;
    }

    /**
     * Deletes the data for the node $node from the data store.
     *
     * @param ezcTreeNode $node
    public function deleteDataForNode( ezcTreeNode $node )
    {
    }
     */

    /**
     * Deletes the data for all the nodes in the node list $nodeList.
     *
     * @param ezcTreeNodeList $nodeList
     */
    public function deleteDataForNodes( ezcTreeNodeList $nodeList )
    {
        // This is a no-op as the data is part of the nodes
    }

    /**
     * Deletes the data for all the nodes in the store.
     */
    public function deleteDataForAllNodes()
    {
        // This is a no-op as the data is part of the nodes
    }

    /**
     * Retrieves the data for the node $node from the data store and assigns it
     * to the node's 'data' property.
     *
     * @param ezcTreeNode $node
     */
    public function fetchDataForNode( ezcTreeNode $node )
    {
        $id = $node->id;
        $elem = $this->dom->getElementById( "{$node->tree->prefix}{$id}" );
        $dataElem = $elem->getElementsByTagNameNS( 'http://components.ez.no/Tree/data', 'data' )->item( 0 );
        if ( $dataElem === null || ( (string) $dataElem->parentNode->getAttribute( 'id' ) !== "{$node->tree->prefix}{$id}" ) )
        {
            throw new ezcTreeDataStoreMissingDataException( $node->id );
        }

        $node->injectData( $dataElem->firstChild->data );
        $node->dataFetched = true;
    }

    /**
     * Retrieves the data for all the nodes in the node list $nodeList and
     * assigns this data to the nodes' 'data' properties.
     *
     * @param ezcTreeNodeList $nodeList
     */
    public function fetchDataForNodes( ezcTreeNodeList $nodeList )
    {
        foreach ( $nodeList->nodes as $node )
        {
            if ( $node->dataFetched === false )
            {
                $this->fetchDataForNode( $node );
            }
        }
    }

    /**
     * Stores the data in the node to the data store.
     *
     * @param ezcTreeNode $node
     */
    public function storeDataForNode( ezcTreeNode $node )
    {
        // Locate the element
        $id = $node->id;
        $elem = $this->dom->getElementById( "{$node->tree->prefix}{$id}" );

        // Create the new element
        $dataNode = $elem->ownerDocument->createElementNS( 'http://components.ez.no/Tree/data', 'etd:data', $node->data );

        // Locate the data element, and remove it
        $dataElem = $elem->getElementsByTagNameNS( 'http://components.ez.no/Tree/data', 'data' )->item( 0 );
        if ( $dataElem !== null )
        {
            $dataElem->parentNode->replaceChild( $dataNode, $dataElem );
        }
        else
        {
            $elem->appendChild( $dataNode );
        }

        // Create the new data element and add it
        $node->dataStored = true;
        if ( !$node->tree->inTransactionCommit() )
        {
            $node->tree->saveFile();
        }
    }
}
?>
