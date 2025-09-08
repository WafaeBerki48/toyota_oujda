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
        $instagram       = $row['instagram'];

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
      <li><a href="home.php" class="active">Accueil</a></li>
      <li><a href="about.php">À propos</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="feautred.php" >testimonials</a></li>
      <li><a href="contact.php" >Contact</a></li>

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

<header>
    <div class="container header-container">
        <div class="header-left">
            <h1>Tours De L'Oriental</h1>
            <h3>Oujda / Berkane</h3>
            <p class="paragraphe">
                Tours De L'Oriental est votre référence automobile à Oujda et Berkane. Spécialisée dans la vente de véhicules Toyota, 
                notre maison vous propose un large choix de modèles adaptés à tous les besoins : citadines, SUV, berlines ou utilitaires. 
                Nous nous engageons à offrir des voitures fiables, modernes et économiques, avec un service client de proximité et de qualité. 
                Faites confiance à l’expertise locale pour votre prochain véhicule.
            </p>
            <a href="car_slider.php" class="btn">Découvrir voitures</a>
        </div>
        <div class="header-right">
            <div class="sq-box">
                <img src="img/car2.webp" alt="">
            </div>
        </div>
    </div>
    <div class="sq-box2"></div>
</header>

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
</html>
