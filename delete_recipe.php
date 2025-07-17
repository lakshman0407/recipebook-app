<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$sql = "DELETE FROM recipes WHERE id = '$id' AND user_id = '$user_id'";
$conn->query($sql);

header("Location: view_recipes.php");
exit();
