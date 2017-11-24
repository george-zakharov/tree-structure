<?php
require 'DbConnector.php';

/**
 * Class Model.
 * Perform the operations with DB.
 */
class Model
{
    /**
     * Get nodes from DB.
     * For default the $id is set to null and method returns all nodes (all root nodes too).
     * If the $id of the node is provided, method returns this node and all nested nodes.
     * @param int $id
     * @return array
     * @throws Exception
     */
    public static function getNodes($id = null)
    {
        if ($id === null) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'SELECT name, level 
                 FROM nodes 
                 ORDER BY left_key'
            );
        } elseif ($id > 0) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'SELECT name, level 
                 FROM nodes 
                 WHERE left_key >= (SELECT left_key FROM nodes WHERE id = ?) 
                 AND right_key <= (SELECT right_key FROM nodes WHERE id = ?) ORDER BY left_key'
            );
        } else {
            throw new Exception('id of the node is not correct');
        }
        
        $stmt->execute(array($id, $id));
        
        return $stmt->fetchAll();
    }

    /**
     * Set new node to the tree.
     * If $parent_name is `null` and $new_node_name is provided, a new root node sets.
     * @param null $parent_name
     * @param $new_node_name
     * @throws Exception
     */
    public static function setNode($parent_name = null, $new_node_name)
    {
        if ($parent_name === null) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'SELECT MIN(level) as level, MAX(right_key) as right_key 
                 FROM nodes'
            );
        } elseif (is_string($parent_name)) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'SELECT level, right_key 
                 FROM nodes 
                 WHERE name = ?'
            );
        } else {
            throw new Exception('Need string or null in $parent_name');
        }
        
        $stmt->execute(array($parent_name));
        $position = $stmt->fetchAll();
        $level = $position[0]['level'];
        $right_key = $position[0]['right_key'];

        if (isset($new_node_name) && $parent_name === null) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'INSERT INTO nodes 
                 SET left_key = :right_key + 1, right_key = :right_key + 2, level = :level, name = :name'
            );
        } elseif (isset($new_node_name) && is_string($parent_name)) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'UPDATE nodes 
                 SET right_key = right_key + 2, left_key = IF(left_key > :right_key, left_key + 2, left_key) 
                 WHERE right_key >= :right_key;
                 INSERT INTO nodes 
                 SET left_key = :right_key, right_key = :right_key + 1, level = :level + 1, name = :name'
            );
        } else {
            throw new Exception('Need name of the new node in $new_node_name');
        }
        
        $stmt->bindParam(':level', $level, PDO::PARAM_INT);
        $stmt->bindParam(':right_key', $right_key, PDO::PARAM_INT);
        $stmt->bindParam(':name', $new_node_name, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * Delete node from tree.
     * By default $id is `null` and the whole tree can be deleted.
     * @param null $id
     * @throws Exception
     */
    public static function deleteNode($id = null)
    {
        if ($id === null) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'DELETE
                 FROM nodes'
            );
        } elseif ($id > 0) {
            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'SELECT left_key, right_key FROM nodes WHERE id = ?'
            );
            
            $stmt->execute(array($id));
            $position = $stmt->fetchAll();
            $left_key = $position[0]['left_key'];
            $right_key = $position[0]['right_key'];

            $stmt = DbConnector::getInstance()->getConnection()->prepare(
                'DELETE FROM nodes 
                 WHERE left_key >= :left_key 
                 AND right_key <= :right_key;
                 UPDATE nodes 
                 SET left_key = IF(left_key > :left_key, left_key - (:right_key - :left_key + 1), left_key), 
                 right_key = right_key - (:right_key - :left_key + 1) 
                 WHERE right_key > :right_key'
            );
        } else {
            throw new Exception('id of the node is not correct');
        }
        
        $stmt->bindParam(':left_key', $left_key, PDO::PARAM_INT);
        $stmt->bindParam(':right_key', $right_key, PDO::PARAM_INT);
        $stmt->execute();
    }
}
