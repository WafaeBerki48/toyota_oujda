<?php
    $conn = new mysqli("localhost", "root", "", "tours_oriental");

    if ($conn->connect_error) {
        die("Erreur connexion DB: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM settings WHERE id = 1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $address_oujda   = $row['address_oujda'];
        $phone1_oujda    = $row['phone1_oujda'];
        $phone2_oujda    = $row['phone2_oujda'];
        $address_berkane = $row['address_berkane'];
        $phone1_berkane  = $row['phone1_berkane'];
        $email_contact   = $row['email_contact'];
        $facebook        = $row['facebook'];
    } else {
        echo "Aucune donnée trouvée";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="img/icon.svg">
    <title>Tours de l'oriental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<nav>
  <div class="container nav-container">
    <a href="#" class="logo">
      <img src="img/icon.svg" alt="Logo">
    </a>

    <div class="menu-toggle" id="menu-toggle">
      <i class="fa-solid fa-bars"></i>
    </div>
    <div class="menu-close" id="menu-close" style="display: none;">
      <i class="fa-solid fa-xmark"></i>
    </div>

    <ul class="nav-link" id="nav-link">
      <li><a href="home.php">Accueil</a></li>
      <li><a href="about.php" class="active">À propos</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="feautred.php" >testimonials</a></li>
      <li><a href="contact.php">Contact</a></li>

      <li class="mobile-socials">
        <a href="<?= $facebook ?>"><i class="fab fa-facebook"></i></a>
        <a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a>
      </li>
    </ul>

    <ul class="social-link">
      <li><a href="<?= $facebook ?>"><i class="fab fa-facebook"></i></a></li>
      <li><a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a></li>
    </ul>
  </div>
</nav>

<div class="all">
    <div class="heading">
        <h1>À propos de nous</h1>
        <p>Votre référence en matière de vente de véhicules dans la région de l’Oriental.</p>
    </div>
    <div class="container2">
        <section class="about">
            <div class="about-image">
            <img src="img/about.jpg" id="loupe" alt="toyota_agence">
            </div>
            <div class="about-content">
                <h2>Tours de l'oriental</h2>
                <p>Tours de l’Oriental est une entreprise spécialisée dans la vente de voitures neuves, implantée au cœur de la région de l’Oriental.
                    Depuis notre création, nous nous engageons à offrir à nos clients un large choix de véhicules de qualité, soigneusement sélectionnés pour répondre à tous les goûts et à tous les budgets.
                    Que vous cherchiez une citadine économique, une berline confortable, un SUV robuste ou encore une voiture hybride moderne, notre équipe est là pour vous conseiller et vous accompagner à chaque étape de votre achat.
                    Nous mettons un point d'honneur à garantir la transparence, la sécurité et la satisfaction client, avec des véhicules contrôlés, des prix compétitifs et un service après-vente fiable.
                </p>
            </div>
        </section>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- Pages principales -->
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="home.php" >Accueil</a></li>
                    <li><a href="car_slider.php" >Modèles Toyota</a></li>
                    <li><a href="services.php" >Services</a></li>
                    <li><a href="contact.php" >Contact</a></li>
                    <li><a href="about.php" >À propos</a></li>
                    <li><a href="feautred.php" >Testimonials</a></li>
                </ul>
            </div>

            <!-- Modèles Toyota -->
            <div class="footer-col">
                <h4>Modèles Disponibles</h4>
                <ul>
                    <li><a href="product_detaille/index.php" >Land Cruiser Prado</a></li>
                    <li><a href="product_detaille/index2.php" >Yaris Cross (Hybride)</a></li>
                    <li><a href="product_detaille/index3.php" >New Yaris (Dispo Hybride)</a></li>
                    <li><a href="product_detaille/index4.php" >Corolla Sport 140 (Hybride)</a></li>
                    <li><a href="product_detaille/index5.php" >Corolla Prestige (Hybride)</a></li>
                    <li><a href="product_detaille/index6.php" >Corola X Suv (Hybride)</a></li>
                    <li><a href="product_detaille/index7.php">Rav 4 (Hybride)</a></li>
                    <li><a href="product_detaille/index8.php" >Fortuner</a></li>
                    <li><a href="product_detaille/index9.php" >Hilux Simple Cabine</a></li>
                    <li><a href="product_detaille/index10.php" >Hilux Double Cabine</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <ul style="color: black;">
                    <div class="aa">
                        <li><strong>Oujda :</strong> <?= $address_oujda ?></li>
                        <li>Tél1 : <?= $phone1_oujda ?></li>
                        <li>Tél2 : <?= $phone2_oujda ?></li>
                        <br>
                        <li><strong>Berkane :</strong> <?= $address_berkane ?></li>
                        <li>Tél : <?= $phone1_berkane ?></li>
                        <br>
                        <li>Email : <?= $email_contact ?></li>
                    </div>
                </ul>
            </div>

            <!-- Réseaux sociaux -->
            <div class="footer-col">
                <h4>Suivez-nous</h4>
                <div class="social-links">
                    <a href="<?= $facebook ?>"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="app.js"></script>
</body>
</html>

