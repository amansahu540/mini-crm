<?php
$conn = new mysqli("localhost", "root", "", "mini_crm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
