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
     * @param int $id
     */
    public function showTree($id = 1)
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
}