<?php
session_start();
require_once 'config.php';
$users_id = $_GET['id'];
$cust = $_GET['name'];

//logs query
$logsquery = "INSERT INTO logs (user,description) VALUES ('" . htmlspecialchars($_SESSION["username"]) . "','Deleted customer $cust')";
$logsresult = mysqli_query($link, $logsquery) or die(mysqli_error($link));


$query = "DELETE from customers WHERE id='$users_id'";

$result = mysqli_query($link, $query) or die(mysqli_error($link));


if ($result){
    header("Location: customer-manage.php?alert=deletesuccess");
}else {
    echo "Error deleting record: " . mysqli_error($link);
}


// Close connection
mysqli_close($link);
?>
