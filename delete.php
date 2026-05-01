<?php
include("config.php");
session_start();

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM notes WHERE id=$id AND user_id=$user_id";
$res = mysqli_query($conn, $sql);

if(mysqli_num_rows($res) > 0){

    $row = mysqli_fetch_assoc($res);

    if(file_exists($row['file_path'])){
        unlink($row['file_path']);
    }

    mysqli_query($conn, "DELETE FROM notes WHERE id=$id");
}

header("Location: notes.php");
exit();
?>