<?php
require 'DbConnector.php';

/**
 * Class Model.
 * Perform the operations with DB.
 */
class Model
{
    /**
     * This method gets nodes from DB.
     * For default the $id is set to 1 and method returns all nodes.
     * If the $id of the node is provided, method returns this node and all nested nodes.
     * @param int $id
     * @return array
     */
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