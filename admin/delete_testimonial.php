<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit;
}

// Vérifier que l'ID est fourni
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: testimonials.php");
    exit;
}

$host = 'localhost';
$db = 'tours_oriental';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer le chemin de l'image pour suppression
    $stmt = $pdo->prepare("SELECT image FROM testimonials WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $testimonial = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($testimonial) {
        $imagePath = $testimonial['image'];

        // Supprimer le témoignage
        $deleteStmt = $pdo->prepare("DELETE FROM testimonials WHERE id = ?");
        $deleteStmt->execute([$_GET['id']]);

        // Supprimer l'image du serveur si elle existe et n'est pas l'image par défaut
        if (!empty($imagePath) && file_exists($imagePath) && strpos($imagePath, 'img/') !== 0) {
            unlink($imagePath);
        }
    }

    header("Location: testimonials.php?success=deleted");
    exit;

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

