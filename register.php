<?php
include("config.php");

$error = "";
$success = "";

if(isset($_POST['register'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($name) || empty($email) || empty($password)){
        $error = "All fields are required!";
    } else {

        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $res = $check->get_result();

        if($res->num_rows > 0){
            $error = "Email already exists!";
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hash);

            if($stmt->execute()){
                $success = "Registered successfully! Please login.";
            } else {
                $error = "Something went wrong!";
            }
        }
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    <input name="name" placeholder="Name" required><br><br>
    <input name="email" type="email" placeholder="Email" required><br><br>
    <input name="password" type="password" placeholder="Password" required><br><br>
    <button name="register">Register</button>
</form>

<p style="color:red;"><?php echo $error; ?></p>
<p style="color:green;"><?php echo $success; ?></p>