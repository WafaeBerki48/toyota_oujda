<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: home.php");
        exit;
    }

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $pdo = new PDO("mysql:host=localhost;dbname=tours_oriental;charset=utf8mb4", 'root', '');
        $stmt = $pdo->prepare("DELETE FROM contact_us WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: messages.php");
    exit;
?>