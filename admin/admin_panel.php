<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: home.php"); // ou autre page
        exit;
    }

    // Connexion à la base de données
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

    // Nombre de messages (lignes dans contact_us)
    $stmtMessages = $pdo->query("SELECT COUNT(*) FROM contact_us");
    $totalMessages = $stmtMessages->fetchColumn();

    // Somme des étoiles dans testimonials
    $stmtStars = $pdo->query("SELECT SUM(stars) FROM testimonials");
    $totalStars = $stmtStars->fetchColumn();




    // Compter total
    $stmtTotal = $pdo->query("SELECT COUNT(*) FROM testimonials");
    $totalTestimonials = $stmtTotal->fetchColumn();

    // Compter chaque nombre d’étoiles
    $starCounts = [];
    for ($i = 5; $i >= 1; $i--) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM testimonials WHERE stars = ?");
        $stmt->execute([$i]);
        $count = $stmt->fetchColumn();
        $starCounts[$i] = $count;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="../img/icon.svg">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Tours de l'oriental</title>
</head> 
<body>
	<!-- SIDEBAR -->
<section id="sidebar">
	<a href="#" class="brand">
		<img class="logo" src="../img/icon.svg" alt="Logo"><br>
		<span class="text">Tours de l'oriental</span>
	</a>
	<ul class="side-menu top">
		<li class="active">
			<a href="admin_panel.php">
				<i class='bx bxs-dashboard' ></i>
				<span class="text">Dashboard</span>
			</a>
		</li>
		<li>
			<a href="testimonials.php">
				<i class='bx bxs-user-voice'></i>
				<span class="text">Testimonials</span>
			</a>
		</li>
		<li>
			<a href="messages.php">
				<i class='bx bxs-message-dots' ></i>
				<span class="text">Message</span>
			</a>
		</li>
	</ul>
	<ul class="side-menu">
		<li>
			<a href="settings.php">
				<i class='bx bxs-cog' ></i>
				<span class="text">Settings</span>
			</a>
		</li>
		<li>
			<a href="logout.php" >
				<i class='bx bxs-log-out-circle' ></i>
				<span class="text">Logout</span>
			</a>
		</li>
	</ul>
</section>
	<!-- SIDEBAR -->
	<!-- CONTENT -->
<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
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
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-message-dots'></i>
					<span class="text">
						<h3><?= $totalMessages ?></h3>
						<p>Messages reçus</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i> 
					<span class="text">
						<h3><?= $totalTestimonials ?></h3>
						<p>Total Testimonials </p>
					</span>
				</li>
			</ul>
        <div class="star-analysis-container">
            <h2>Analyse des étoiles ⭐</h2>
            <canvas
                id="starChart"
                data-star5="<?= $starCounts[5] ?>"
                data-star4="<?= $starCounts[4] ?>"
                data-star3="<?= $starCounts[3] ?>"
                data-star2="<?= $starCounts[2] ?>"
                data-star1="<?= $starCounts[1] ?>"
            ></canvas>
        </div>


	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		</main>
		<!-- MAIN -->
</section>
	<!-- CONTENT -->
	

<script src="app.js"></script>
</body>
</html>