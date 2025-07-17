<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $steps = trim($_POST['steps']);
    $category = trim($_POST['category']);
    $user_id = $_SESSION['user_id'];

    if ($title != '' && $ingredients != '' && $steps != '') {
        $sql = "INSERT INTO recipes (user_id, title, ingredients, steps, category) VALUES ('$user_id', '$title', '$ingredients', '$steps', '$category')";
        if ($conn->query($sql) === TRUE) {
            $message = "Recipe added successfully!";
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
    <title>Add Recipe</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add a New Recipe</h2>
        <form method="post">
            <label>Title:</label>
            <input type="text" name="title">

            <label>Ingredients:</label>
            <textarea name="ingredients" rows="4" cols="40"></textarea>

            <label>Steps:</label>
            <textarea name="steps" rows="4" cols="40"></textarea>

            <label>Category:</label>
            <input type="text" name="category" placeholder="e.g. Breakfast, Dinner">

            <input type="submit" value="Add Recipe">
        </form>
        <p class="message"><?php echo $message; ?></p>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
