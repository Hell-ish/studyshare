<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<h1>Welcome <?php echo $_SESSION['user_name']; ?> 🎉</h1>

<a href="upload.php">Upload Notes</a><br>
<a href="notes.php">View Notes</a><br>
<a href="logout.php">Logout</a>