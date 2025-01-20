<?php
$host = 'localhost';
$user = 'root'; // ganti dengan username database Anda
$password = ''; // ganti dengan password database Anda
$database = 'lpsi'; // ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>