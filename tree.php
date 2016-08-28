<?php
error_reporting(E_ALL);
require 'App/NodeHandler.php';
$nodes = new NodeHandler();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tree-structure</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<!-- Navigation -->
<nav>
    <ul class="menu">
        <li><a href="index.php">Enter node</a></li>
        <li><a href="delete.php">Delete node</a></li>
        <li><a href="tree.php">Tree</a></li>
    </ul>
</nav>
<!-- Header text -->
<h1 class="lead_header">Tree Structure Representation</h1>
<!-- Tree structure -->
<h2>Whole Tree</h2>
<?php
$nodes->showTree();
?>
<h2>Section of the Tree</h2>
<?php
$nodes->showTree(3);
?>
</body>
</html>