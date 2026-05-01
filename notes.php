<?php
include("config.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM notes 
            WHERE title LIKE '%$search%' 
            OR subject LIKE '%$search%' 
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM notes ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
?>

<h1>Notes</h1>

<form method="GET">
    <input name="search" placeholder="Search...">
    <button>Search</button>
</form>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div>
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['subject']; ?></p>

    <a href="view.php?file=<?php echo basename($row['file_path']); ?>">View</a>
    <a href="<?php echo $row['file_path']; ?>" download>Download</a>
    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>

    <hr>
</div>

<?php } ?>