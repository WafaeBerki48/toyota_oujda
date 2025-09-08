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
      $about   = "message cross";

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
<body class="page-yaris">

<nav>
  <ul class="sidebar">
    <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota Yaris Cross </li>
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
        <img src="image/yaris_cross/white/2.jpg" class="slide">
      </div>
      <div class="option flex">
        <img src="image/yaris_cross/white/2.jpg" onclick="img('image/yaris_cross/white/2.jpg')">
        <img src="image/yaris_cross/white/4.jpg" onclick="img('image/yaris_cross/white/4.jpg')">
        <img src="image/yaris_cross/white/8.jpg" onclick="img('image/yaris_cross/white/8.jpg')">
        <img src="image/yaris_cross/white/16.jpg" onclick="img('image/yaris_cross/white/16.jpg')">
        <img src="image/yaris_cross/white/19.jpg" onclick="img('image/yaris_cross/white/19.jpg')">
        <img src="image/yaris_cross/white/24.jpg" onclick="img('image/yaris_cross/white/24.jpg')">
        <img src="image/yaris_cross/white/36.jpg" onclick="img('image/yaris_cross/white/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota Yaris Cross </h3>
      <p class="paragraphe">
        La Toyota Yaris Cross  combine design moderne, économie de carburant et technologie hybride avancée. 
        Idéale pour la ville comme pour les longs trajets, elle offre confort et sécurité.      
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#000;" onclick="switchColor('black')"></span>
        <span style="background:#fff;border:1px solid #ccc;" onclick="switchColor('white')"></span>
        <span style="background:#1e3a8a;" onclick="switchColor('bleu')"></span>
        <span style="background:#d6b019;" onclick="switchColor('jeune')"></span>
        <span style="background:#dc2626;" onclick="switchColor('rouge')"></span>
        <span style="background:#674734;" onclick="switchColor('maron')"></span>
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
    <img id="car-image" src="image/voiture_yaris.jpg" alt="Voiture Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/cross_pdf.pdf" download class="download-btn" title="Télécharger le PDF">
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


<script src="js/app.js"></script>

</body>
</html>
