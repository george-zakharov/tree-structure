<?php
require 'Model.php';

class NodeHandler
{
    public function showTree($id = 1)
    {
        $result = Model::getNodes($id);
        foreach ($result as $node) {
            //TODO:use nl2br
            echo str_pad($node['name'], strlen($node['name']) + $node['level'] - 1, "-", STR_PAD_LEFT) . "<br>";
        }
    }
}