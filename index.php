<?php
include 'db.php';
session_start();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($username != '' && $email != '' && $password != '') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            $message = "🎉 Registration successful! Redirecting to login...";
            header("refresh:2;url=login.php");
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - RecipeBook</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Create an Account</h2>
        <form method="post">
            <label>Username</label>
            <input type="text" name="username">

            <label>Email</label>
            <input type="email" name="email">

            <label>Password</label>
            <input type="password" name="password">

            <input type="submit" value="Register">
        </form>
        <p class="message"><?php echo $message; ?></p>
        <p style="text-align:center;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
