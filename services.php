<?php
  $conn = new mysqli("localhost", "root", "", "tours_oriental");

  // Vérification de la connexion
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
      <li><a href="home.php">Accueil</a></li>
      <li><a href="about.php">À propos</a></li>
      <li><a href="services.php" class="active">Services</a></li>
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

<section>
  <div class="row">
    <h2 class="section-heading">Nos services</h2>
  </div>
  <div class="row">
    <div class="column">
      <div class="card">
        <div class="icon-wrapper">
          <i class="fas fa-toolbox"></i>
        </div>
        <h3>Entretien périodique</h3>
        <p>
          Assurez la longévité et la performance de votre véhicule grâce à un entretien régulier effectué 
          par nos experts qualifiés, selon les recommandations du constructeur.
        </p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon-wrapper">
          <i class="fas fa-screwdriver-wrench"></i>
        </div>
        <h3>Maintenance & Réparation</h3>
        <p>
          Nos techniciens interviennent avec précision pour diagnostiquer
          et réparer tout type de panne, en utilisant des outils de pointe et des pièces d’origine.
        </p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon-wrapper">
          <i class="fas fa-cogs"></i>
        </div>
        <h3>Pièces & Accessoire d'Origine</h3>
        <p>
          Nos techniciens interviennent avec précision pour diagnostiquer et réparer tout type de panne,
          en utilisant des outils de pointe et des pièces d’origine.
        </p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon-wrapper">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h3>Garantie</h3>
        <p>
          Bénéficiez d’une garantie constructeur sur tous nos services et pièces installées, 
          pour rouler en toute tranquillité et confiance.
        </p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon-wrapper">
          <i class="fas fa-bullhorn"></i>
        </div>
        <h3>Rappel</h3>
        <p>
          En cas de rappel constructeur, nous vous contactons et intervenons 
          gratuitement pour assurer la conformité et la sécurité de votre véhicule.
        </p>
      </div>
    </div>
    <div class="column">
      <div class="card">
        <div class="icon-wrapper">
          <i class="fas fa-car"></i>
        </div>
        <h3>Pneumatique</h3>
        <p>
          Remplacement, équilibrage, réparation ou contrôle de vos pneus : 
          nos spécialistes vous assurent une tenue de route optimale et une conduite sécurisée.
        </p>
      </div>
    </div>
  </div>
</section>

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
