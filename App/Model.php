<?php
require 'DbConnector.php';

class Model
{
    public static function getNodes($id = 1)
    {
        $stmt = DbConnector::getInstance()->getConnection()->prepare(
            'SELECT name, level 
             FROM nodes 
             WHERE left_key >= (SELECT left_key FROM nodes WHERE id = :id) 
             AND right_key <= (SELECT right_key FROM nodes WHERE id = :id) ORDER BY left_key'
        );
        $stmt->execute(array('id' => $id));
        return $stmt->fetchAll();
    }
}