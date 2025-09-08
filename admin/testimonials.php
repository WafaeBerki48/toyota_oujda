<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: home.php");
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
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    // Recherche et tri
    $search = $_GET['search'] ?? '';
    $sort = strtolower($_GET['sort'] ?? 'desc');
    $sort = $sort === 'asc' ? 'ASC' : 'DESC';

    // Compter le total
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM testimonials");
    $totalTestimonials = $stmtCount->fetchColumn();

    // Récupérer les témoignages
    $sql = "SELECT * FROM testimonials WHERE name LIKE :search ORDER BY created_at $sort";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Lien tri inverse
    $inverseSort = $sort === 'ASC' ? 'desc' : 'asc';
    $queryParams = ['sort' => $inverseSort];
    if (!empty($search)) $queryParams['search'] = $search;
    $sortUrl = '?' . http_build_query($queryParams);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="../img/icon.svg">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Gestion Témoignages</title>
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
        <li><a href="settings.php"><i class='bx bxs-cog'></i><span class="text">Settings</span></a></li>
        <li><a href="logout.php"><i class='bx bxs-log-out-circle'></i><span class="text">Logout</span></a></li>
    </ul>
</section>

<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
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
                <h1>Témoignages</h1>
                <ul class="breadcrumb">
                    <li><a href="admin_panel.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="testimonials.php">Testimonials</a></li>
                </ul>
            </div>
        </div>

        <!-- Titre + recherche -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin: 20px 0;">
            <h2>Liste des témoignages (<?= $totalTestimonials ?>)</h2>
            <form method="get" style="display: flex; gap: 10px; align-items: center;">
                <input type="text" class="input2" name="search" placeholder="Rechercher par nom" value="<?= htmlspecialchars($search) ?>">
                <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                <button class="btn-action reply" type="submit">Rechercher</button>
            </form>
        </div>

        <!-- Tableau -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <!-- <th>Image</th> -->
                        <th>Étoiles</th>
                        <th>Commentaire</th>
                        <th>
                            <a href="<?= $sortUrl ?>" style="text-decoration: none; color: inherit;">
                                Date <?= $sort === 'ASC' ? '↑' : '↓' ?>
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($testimonials as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['id']) ?></td>
                        <td><?= htmlspecialchars($t['name']) ?></td>
                        <!-- <td>
                            <img src="../<?= htmlspecialchars($row['image']) ?>" alt="Testimonial">
                        </td> -->
                        <td><?= htmlspecialchars($t['stars']) ?></td>
                        <td><?= nl2br(htmlspecialchars($t['comment'])) ?></td>
                        <td><?= htmlspecialchars($t['created_at'] ?? 'N/A') ?></td>
                        <td>
                            <a href="edit_testimonial.php?id=<?= $t['id'] ?>" class="btn-action reply">Modifier</a>
                            <button class="btn-action delete" data-id="<?= $t['id'] ?>">Supprimer</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</section>

<!-- MODAL -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <p>Voulez-vous vraiment supprimer ce témoignage ?</p>
        <div class="modal-buttons">
            <button id="confirmDeleteBtn">Oui</button>
            <button id="cancelDeleteBtn">Non</button>
        </div>
    </div>
</div>
<script src="app2.js"></script>
</body>
</html>
