<?php
/**
 * File containing the ezcTreeTransactionItem class.
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
 * A container to store one tree modifying transaction item.
 *
 * @package Tree
 * @version //autogentag//
 * @access private
 */
class ezcTreeTransactionItem extends ezcBaseStruct
{
    /**
     * Used when this transaction deals with adding nodes.
     */
    const ADD = 1;

    /**
     * Used when this transaction deals with deleting nodes.
     */
    const DELETE = 2;

    /**
     * Used when this transaction deals with moving nodes.
     */
    const MOVE = 3;

    /**
     * The item type.
     *
     * Either ADD, DELETE or MOVE.
     *
     * @var int
     */
    public $type;

    /**
     * Contains the node this transaction item is for.
     *
     * Used for "add" items.
     *
     * @var ezcTreeNode
     */
    public $node;

    /**
     * Contains the node ID this transaction item is for.
     *
     * Used for "move" and "delete" items.
     *
     * @var string
     */
    public $nodeId;

    /**
     * Contains the parent node ID this transaction item is for.
     *
     * Used for "add" and "move" items
     *
     * @var string
     */
    public $parentId;

    /**
     * Constructs an ezcTreeTransactionItem object.
     *
     * @param int $type Either ADD, DELETE or REMOVE
     * @param ezcTreeNode $node
     * @param string $nodeId
     * @param string $parentId
     */
    public function __construct( $type, $node = null, $nodeId = null, $parentId = null )
    {
        $this->type = $type;
        $this->node = $node;
        $this->nodeId = $nodeId;
        $this->parentId = $parentId;
    }
}
?>
