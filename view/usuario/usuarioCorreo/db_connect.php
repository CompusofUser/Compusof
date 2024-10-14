<?php
$dbname = "Compusof";
$dbuser = "root";
$dbpassword = "";
$dbhost = "localhost";

$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>