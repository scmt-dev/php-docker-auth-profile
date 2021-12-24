<?php
// connect database
$db = new mysqli('db', 'root', 'root', 'example');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}
?>