<?php

require 'Model.php';

/**
 * Class NodeHandler.
 * Gives the representation of nodes to page.
 */
class NodeHandler
{
    /**
     * Show the tree of nodes.
     * For default all tree is shown.
     *
     * @param null $id
     *
     * @throws Exception
     */
    public function showTree($id = null): void
    {
        //Get nodes from DB
        $result = Model::getNodes($id);
        //Go through array
        foreach ($result as $node) {
            //Echo nodes by row.
            //Use nl2br to change "\n" to "<br>" on the output.
            //Use str_pad to add symbol "-" before each node.
            //Use `strlen($node['name']) + $node['level']` to set number of symbols "-" equal to level of the node.
            echo nl2br(str_pad($node['name'], strlen($node['name']) + $node['level'], "-", STR_PAD_LEFT) . "\n");
        }
    }

    /**
     * Add new node.
     * For default new node sets to root level with `$parent_name = null` provided.
     *
     * @param null $parent_name
     * @param $new_node_name
     *
     * @throws Exception
     */
    public function addNewNode($new_node_name, $parent_name = null): void
    {
        Model::setNode($parent_name, $new_node_name);
    }

    /**
     * Delete node.
     * For default delete whole tree of nodes.
     *
     * @param null $id
     *
     * @throws Exception
     */
    public function deleteNode($id = null): void
    {
        Model::deleteNode($id);
    }
}