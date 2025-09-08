<?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbname     = "tours_oriental";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connexion échouée: " . $conn->connect_error);
  }

  $formMessage = "";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $name    = $conn->real_escape_string($_POST['name']);
      $email   = $conn->real_escape_string($_POST['email']);
      $phone   = $conn->real_escape_string($_POST['phone']);
      $message = $conn->real_escape_string($_POST['message']);
      $about   = "message prado";

      $sql = "INSERT INTO contact_us (name, about, email, phone, message, created_at) 
              VALUES ('$name', '$about', '$email', '$phone', '$message', NOW())";

      if ($conn->query($sql) === TRUE) {
          $formMessage = "Votre message a bien été envoyé !";
      } else {
          $formMessage = "Erreur lors de l'envoi : " . $conn->error;
      }
  }

  $conn->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tours de l'oriental</title>
  <link rel="website icon" type="svg" href="../img/icon.svg">
  <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-prado">

<nav>
  <ul class="sidebar">
    <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Land Cruiser Prado <span>(2024)</span></li>
    <li class="hideOnMobile"><a href="#presentation">Présentation</a></li>
    <li class="hideOnMobile"><a href="#caracteristiques">Caractéristiques</a></li>
    <li class="hideOnMobile"><a href="../car_slider.php"><button class="retour">retour</button></a></li>
    <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
  </ul>
</nav>

<section id="presentation">
  <div class="container flex">
    <!-- LEFT -->
    <div class="left">
      <div class="main_image">
        <!-- image principale -->
        <img src="image/prado/prado_white/2.jpg" class="slide">
      </div>
      <!-- miniatures -->
      <div class="option flex">
        <img src="image/prado/prado_white/4.jpg" onclick="img('image/prado/prado_white/4.jpg')">
        <img src="image/prado/prado_white/8.jpg" onclick="img('image/prado/prado_white/8.jpg')">
        <img src="image/prado/prado_white/16.jpg" onclick="img('image/prado/prado_white/16.jpg')">
        <img src="image/prado/prado_white/19.jpg" onclick="img('image/prado/prado_white/19.jpg')">
        <img src="image/prado/prado_white/24.jpg" onclick="img('image/prado/prado_white/24.jpg')">
        <img src="image/prado/prado_white/36.jpg" onclick="img('image/prado/prado_white/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota Land Cruiser Prado 2024</h3>
      <p class="paragraphe">
        Le Toyota Prado 2024 allie puissance, luxe et fiabilité. Parfait aussi bien pour la conduite en ville que pour les aventures extrêmes en tout-terrain, 
        le Prado offre des performances inégalées, un confort haut de gamme et des fonctionnalités de sécurité avancées.      
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#000;" onclick="switchColor('black')"></span> <!-- Noir -->
        <span style="background:#fff;border:1px solid #ccc;" onclick="switchColor('white')"></span> <!-- Blanc -->
        <span style="background:#1e3a8a;" onclick="switchColor('blue')"></span> <!-- Bleu -->
        <span style="background:#d1d5db;" onclick="switchColor('gris_clair')"></span> <!-- Gris clair -->
        <span style="background:#4b5563;" onclick="switchColor('gris_fonce')"></span> <!-- Gris foncé -->
        <span style="background:#c1652b;" onclick="switchColor('moutarde')"></span> <!-- moutarde -->
      </div>
    </div>
  </div>
</section>

<div class="wrap" id="caracteristiques">
  <aside class="panel" id="list">
    <div class="tabs">
      <button id="btn-avant" class="active">Avant</button>
      <button id="btn-arriere">Arrière</button>
    </div>
  </aside>

  <section class="stage" id="stage">
    <img id="car-image" src="image/voiture1.png" alt="Voiture Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/prado_pdf.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index.php" method="POST">
      <?php if(isset($formMessage)) { echo '<p class="form-message">'.$formMessage.'</p>'; } ?>
      <input type="text" name="name" placeholder="Nom" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Téléphone" required>
      <textarea name="message" rows="3" placeholder="Message" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
</div>

<script src="js/app.js">  </script>

</body>
</html>
