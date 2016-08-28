# Tree structure project #

## Files ##

### index.php ###

* It is the entrance of the Application.
* It requires _NodeHandler.php_ and new object _NodeHandler_ creates there.
* At the top of the code block the possible realization of the inserting and deleting of nodes is presented 
under comments.
* Inside `<!-- Tree structure -->` block of html there are `$nodes->showTree()` and `$nodes->showTree(3)`
that provides representation of __Nodes Tree__ in two modes:
    * `$nodes->showTree()` show the whole __Tree of Nodes__,
    * `$nodes->showTree(3)` show the part of __Tree of Nodes__ limited by __node__ with `$id = 3`.

### main.css ###

* This is the main stylesheet of the application.

### App/DbConnector.php ###

* Provides connection to __Database__ via singleton pattern.
* Parameters for connection stores in properties of the class _DbConnector_:
    * `$host` for host name,
    * `$db_name` for name of the __Database__,
    * `$user` for login,
    * `$pass` for password.
* Main methods are:
    * `getInstance()` for class _DbConnector_,
    * `getConnection()` for _PDO Object_.
    
### App/Model.php ###

* This file store class _Model_ to perform the operations with DB.
* Main methods are:
    * `getNodes()` to show show whole tree of nodes or its part,
    * `setNode()` to add new node to the tree,
    * `deleteNode()` to delete node from tree.
    
### App/NodeHandler.php ###
* This method gives the representation of nodes to page __index.php__.
* Main methods are:
    * `showTree()` to `echo` the whole tree of nodes or its part if _parameter_ is provided,
    * `addNewNode()` to add now node to __Database__ via __Model.php__ to the root or specified level,
    * `deleteNode()` to delete node from __Database__ via __Model.php__ from the specified level or to delete 
    the whole tree.
    
### tree-structure.sql ###
* This is the dump of the tables of my local `tree-structure` __Database__.
* It is partly filled for example.

## Database structure ##
* Data stores via __[Nested Sets](http://phpwiki.ru/tree/ns, 'Link')__ method.
* For example is provided a catalogue (of cars) in such hierarchy:
 * vehicle
    * Type (Motorcycle, Automobile)
        * Brand (Audi, BMW, Ford)
            * Model (A1, A2, Focus, etc.)
                * Year (1999, 2003, etc.)
* All nodes are _nested_ on correspond levels.
* New root level near `vehicle` can be added. For example, `animal` with its own hierarchy of nodes, but bonded with
near _root node_ by `right_key` and `left_key`.