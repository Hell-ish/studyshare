<?php
include("config.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['upload'])){

    $title = trim($_POST['title']);
    $subject = trim($_POST['subject']);

    $file = $_FILES['note']['name'];
    $tmp = $_FILES['note']['tmp_name'];

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if($ext != "pdf"){
        die("Only PDF allowed!");
    }

    $newFile = time() . "_" . basename($file);
    $path = "uploads/" . $newFile;

    if(move_uploaded_file($tmp, $path)){

        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("INSERT INTO notes (title, subject, file_path, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $subject, $path, $user_id);

        $stmt->execute();

        echo "Uploaded successfully!";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input name="title" placeholder="Title" required><br><br>
    <input name="subject" placeholder="Subject" required><br><br>
    <input type="file" name="note" required><br><br>
    <button name="upload">Upload</button>
</form>