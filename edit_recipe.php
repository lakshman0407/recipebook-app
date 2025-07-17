<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$sql = "SELECT * FROM recipes WHERE id = '$id' AND user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    echo "Recipe not found.";
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $steps = trim($_POST['steps']);
    $category = trim($_POST['category']);

    if ($title != '' && $ingredients != '' && $steps != '') {
        $update_sql = "UPDATE recipes SET title='$title', ingredients='$ingredients', steps='$steps', category='$category' WHERE id='$id' AND user_id='$user_id'";
        if ($conn->query($update_sql) === TRUE) {
            header("Location: view_recipes.php");
            exit();
        } else {
            echo "Update failed.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Recipe</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Recipe</h2>
        <form method="post">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo $row['title']; ?>">

            <label>Ingredients:</label>
            <textarea name="ingredients" rows="4" cols="40"><?php echo $row['ingredients']; ?></textarea>

            <label>Steps:</label>
            <textarea name="steps" rows="4" cols="40"><?php echo $row['steps']; ?></textarea>

            <label>Category:</label>
            <input type="text" name="category" value="<?php echo $row['category']; ?>">

            <input type="submit" value="Update Recipe">
        </form>
        <br>
        <a href="view_recipes.php">Back to Recipes</a>
    </div>
</body>
</html>
