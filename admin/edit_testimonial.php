<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: home.php");
        exit;
    }

    // Connexion
    $host = 'localhost';
    $db = 'tours_oriental';
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    // ID valide ?
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("ID invalide");
    }

    $id = (int)$_GET['id'];

    // Récupération du témoignage
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $testimonial = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$testimonial) {
        die("Témoignage introuvable");
    }

    // Si envoi du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $stars = (int)$_POST['stars'];
        $comment = trim($_POST['comment']);

        if (empty($name) || empty($stars) || empty($comment)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            $updateStmt = $pdo->prepare("
                UPDATE testimonials 
                SET name = :name, stars = :stars, comment = :comment 
                WHERE id = :id
            ");
            $updateStmt->execute([
                'name' => $name,
                'stars' => $stars,
                'comment' => $comment,
                'id' => $id
            ]);

            header("Location: testimonials.php?message=updated");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="../img/icon.svg">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Modifier Témoignage</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <img class="logo" src="../img/icon.svg" alt="Logo"><br>
        <span class="text">Tours de l'oriental</span>
    </a>
    <ul class="side-menu top">
        <li><a href="admin_panel.php"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a></li>
        <li class="active"><a href="testimonials.php"><i class='bx bxs-user-voice'></i><span class="text">Testimonials</span></a></li>
        <li><a href="messages.php"><i class='bx bxs-message-dots'></i><span class="text">Message</span></a></li>
    </ul>
    <ul class="side-menu">
        <li><a href="#"><i class='bx bxs-cog'></i><span class="text">Settings</span></a></li>
        <li><a href="logout.php"><i class='bx bxs-log-out-circle'></i><span class="text">Logout</span></a></li>
    </ul>
</section>

<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="testimonials.php" class="nav-link">Retour</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
    </nav>


    <main>
        <div class="head-title">
            <div class="left">
                <h1>Modifier Témoignage</h1>
                <ul class="breadcrumb">
                    <li><a href="admin_panel.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a href="testimonials.php">Testimonials</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Modifier</a></li>
                </ul>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="table-container" >
            <?php if (!empty($error)): ?>
                <div style="color: red; margin-bottom: 10px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post">
                <label for="name">Nom :</label><br>
                <input class="input2" type="text" id="name" name="name" value="<?= htmlspecialchars($testimonial['name']) ?>" required><br>

                <label for="stars">Étoiles :</label><br>
                <input class="input2" type="number" id="stars" name="stars" min="1" max="5" value="<?= htmlspecialchars($testimonial['stars']) ?>" required><br>

                <label for="comment">Commentaire :</label><br>
                <textarea class="input2" id="comment" name="comment" rows="5" required><?= htmlspecialchars($testimonial['comment']) ?></textarea><br>

                <div style="margin-top: 15px; display: flex; gap: 10px;">
                    <button type="submit" class="btn-action reply">Enregistrer</button>
                    <a href="testimonials.php" class="btn-action delete">Annuler</a>
                </div>
            </form>
        </div>
    </main>
</section>

<script src="app.js"></script>
</body>
</html>
