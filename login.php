<?php
include("config.php");
session_start();

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Wrong password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<h2>Login</h2>

<form method="POST">
    <input name="email" type="email" required placeholder="Email"><br><br>
    <input name="password" type="password" required placeholder="Password"><br><br>
    <button name="login">Login</button>
</form>

<p style="color:red;"><?php echo $error; ?> </p>