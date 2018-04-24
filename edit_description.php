<?php
require_once 'header.php';

$id = sanatizeString($_GET['desc_id']); 
$query = queryMysql("SELECT * FROM description WHERE desc_id = '$id' ");
$result = mysqli_fetch_array($query);


if(isset($_POST['submit'])){
    $desc_id = sanatizeString($_POST['desc_id']);
    $description = sanatizeString($_POST['description']);
    queryMysql("UPDATE description SET description ='$description' WHERE desc_id ='$desc_id'");
       
    exit(header('Location:list_description.php'));
 }
?>
<html>
    <head>
        <title>Edit Description</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="edit_description.php" method="post">
    <h2>Edit Description</h2>
    <input name="desc_id" type="text" id="desc_id" size="6" value="<?php echo $result['desc_id'];?>" >
    <input name="description" type="text" id="description" size="20" value="<?php echo $result['description'];?>" >
    <input type="submit" id ="submit" type ="submit" name="submit" value="Update">
    </form>

    </body>
</html>
