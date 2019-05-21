<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'xAcmiyzWOF');
define('DB_PASSWORD', 'cQZ2tArDGK');
define('DB_NAME', 'xAcmiyzWOF');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("POTA" . mysqli_connect_error());
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

Connected to database <strong>xAcmiyzWOF</strong> Succesful!<br>

<br><strong>MyHome Login:</strong>
<br>username: joff
<br>password: joff
