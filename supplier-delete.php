<?php
session_start();
require_once 'config.php';
$users_id = $_GET['id'];
$query = "DELETE from suppliers WHERE id='$users_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: supplier-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}


// Close connection
mysqli_close($link);
?>
