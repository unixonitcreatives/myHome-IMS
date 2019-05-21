<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', '69.195.124.192');
define('DB_USERNAME', 'longrich_myhome');
define('DB_PASSWORD', 'myhome');
define('DB_NAME', 'longrich_myhome_db');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("POTA");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>