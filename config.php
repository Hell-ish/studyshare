<?php
$conn = mysqli_connect("localhost", "root", "", "studyshare");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>