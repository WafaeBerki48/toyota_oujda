<?php
// Connexion BDD
$host = 'localhost';
$db = 'tours_oriental';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des messages
$stmt = $pdo->query("SELECT * FROM contact_us ORDER BY id DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// En-têtes pour téléchargement Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=messages.xls");

// Affichage du contenu en HTML formaté comme Excel
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Message</th>
        <th>Date</th>
    </tr>";

foreach ($messages as $msg) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($msg['id']) . "</td>";
    echo "<td>" . htmlspecialchars($msg['name']) . "</td>";
    echo "<td>" . htmlspecialchars($msg['email']) . "</td>";
    echo "<td>" . htmlspecialchars($msg['phone']) . "</td>";
    echo "<td>" . nl2br(htmlspecialchars($msg['message'])) . "</td>";
    echo "<td>" . htmlspecialchars($msg['created_at'] ?? 'N/A') . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
