<?php
include("../config/config.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$error = "";
$success = "";

// GET NOTE DATA
if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM notes WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $note = $result->fetch_assoc();
    } else {
        die("Note not found or unauthorized access.");
    }
}

// UPDATE NOTE
if(isset($_POST['update'])){

    $id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $subject = trim($_POST['subject']);
    $user_id = $_SESSION['user_id'];

    if(empty($title) || empty($subject)){
        $error = "All fields are required!";
    } else {

        $stmt = $conn->prepare("
            UPDATE notes 
            SET title = ?, subject = ? 
            WHERE id = ? AND user_id = ?
        ");

        $stmt->bind_param("ssii", $title, $subject, $id, $user_id);

        if($stmt->execute()){
            $success = "Note updated successfully!";
        } else {
            $error = "Update failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Note - StudyShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">

        <h3 class="mb-4">✏️ Edit Note</h3>

        <!-- ERROR / SUCCESS -->
        <?php if($error != "") { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <?php if($success != "") { ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php } ?>

        <!-- FORM -->
        <form method="POST">

            <input type="hidden" name="id" value="<?php echo $note['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control"
                       value="<?php echo htmlspecialchars($note['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control"
                       value="<?php echo htmlspecialchars($note['subject']); ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-primary">
                Update Note
            </button>

            <a href="notes.php" class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>
</div>

</body>
</html>