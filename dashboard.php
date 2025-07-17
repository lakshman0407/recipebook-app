<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - RecipeBook</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

        <form>
            <input type="button" value="Add a New Recipe" onclick="location.href='add_recipe.php'"><br><br>
            <input type="button" value="View Your Recipes" onclick="location.href='view_recipes.php'"><br><br>
            <input type="button" value="Logout" onclick="location.href='logout.php'">
        </form>
    </div>
</body>
</html>
