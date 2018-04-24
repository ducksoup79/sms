<?php
require_once 'header.php';
?>

<html>
    <head>
        <title>Add a new description</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
      
        <form action="add_description.php" method="post">
        
    <h2>Add Description</h2>
    <input name="description" type="text" id="description" size="20">
    <input type="submit" value="Create">
    </form>

    </body>
</html>
