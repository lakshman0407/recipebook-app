<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM recipes WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Recipes</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Your Recipes</h2>
        <a href="add_recipe.php">Add New Recipe</a> |
        <a href="dashboard.php">Dashboard</a>
        <hr>

        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="recipe-card">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><strong>Category:</strong> <?php echo $row['category']; ?></p>
                    <p><strong>Ingredients:</strong><br> <?php echo nl2br($row['ingredients']); ?></p>
                    <p><strong>Steps:</strong><br> <?php echo nl2br($row['steps']); ?></p>
                    <p>
                        <a href="edit_recipe.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete_recipe.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No recipes found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
