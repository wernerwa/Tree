<?php
/**
 * File containing the ezcTreeMemoryNode class.
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
 * @access private
 */

/**
 * A container to store one memory tree node with meta data, for use with
 * the ezcTreeMemory backend.
 *
 * @package Tree
 * @version //autogentag//
 * @access private
 */
class ezcTreeMemoryNode extends ezcBaseStruct
{
    /**
     * The parent ezcTreeMemoryNode
     *
     * @var ezcTreeMemoryNode
     */
    public $parent;

    /**
     * The encapsulated ezcTreeNode
     *
     * @var ezcTreeNode
     */
    public $node;

    /**
     * Contains the children of this node
     *
     * @var array(string=>ezcTreeMemoryNode)
     */
    public $children;

    /**
     * Constructs an ezcTreeMemoryNode object.
     *
     * @param ezcTreeNode       $node
     * @param array(string=>ezcTreeMemoryNode) $children
     * @param ezcTreeMemoryNode $parent
     */
    public function __construct( ezcTreeNode $node, array $children, ezcTreeMemoryNode $parent = null  )
    {
        $this->node = $node;
        $this->children = $children;
        $this->parent = $parent;
    }
}
?>
