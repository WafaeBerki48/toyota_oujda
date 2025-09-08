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
      $about   = "message Fortuner";

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

<body class="page-fortuner">

<nav>
  <ul class="sidebar">
    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota Fortuner</li>
    <li class="hideOnMobile"><a href="#presentation">Présentation</a></li>
    <li class="hideOnMobile"><a href="#caracteristiques">Caractéristiques</a></li>
    <li class="hideOnMobile"><a href="../car_slider.php"><button class="retour">retour</button></a></li>
    <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
  </ul>
</nav>

<section id="presentation">
  <div class="container flex">
    <!-- LEFT -->
    <div class="left">
      <div class="main_image">
        <img src="image/fortuner/white/2.png" class="slide">
      </div>
      <div class="option flex">
        <img src="image/fortuner/white/2.png" onclick="img('image/fortuner/white/2.png')">
        <img src="image/fortuner/white/4.png" onclick="img('image/fortuner/white/4.png')">
        <img src="image/fortuner/white/8.png" onclick="img('image/fortuner/white/8.png')">
        <img src="image/fortuner/white/16.png" onclick="img('image/fortuner/white/16.png')">
        <img src="image/fortuner/white/19.png" onclick="img('image/fortuner/white/19.png')">
        <img src="image/fortuner/white/24.png" onclick="img('image/fortuner/white/24.png')">
        <img src="image/fortuner/white/36.png" onclick="img('image/fortuner/white/36.png')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota Fortuner</h3>
      <p class="paragraphe">
        Le Toyota Fortuner est un SUV robuste et élégant, conçu pour les aventures sur route comme en dehors. 
        Il combine confort, sécurité et performance, offrant une expérience de conduite fiable et agréable.
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#000;" onclick="switchColor('black')" title="Noir"></span>
        <span style="background:#9ca3af;" onclick="switchColor('gris')" title="Gris"></span>
        <span style="background:#fff; border:1px solid #ccc;" onclick="switchColor('white')" title="Blanc"></span>
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
    <img id="car-image" src="image/fortuner/black/2.png" alt="Fortuner Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/fortuner.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index8.php" method="POST">
      <?php if(!empty($formMessage)) { echo '<p class="form-message">'.$formMessage.'</p>'; } ?>
      <input type="text" name="name" placeholder="Nom" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Téléphone" required>
      <textarea name="message" rows="3" placeholder="Message" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
</div>

<script src="js/app.js"></script>

<script>
  // Images pour Fortuner
  let imagesFortuner = {
    white: [
      "image/fortuner/white/2.png",
      "image/fortuner/white/4.png",
      "image/fortuner/white/8.png",
      "image/fortuner/white/16.png",
      "image/fortuner/white/19.png",
      "image/fortuner/white/24.png",
      "image/fortuner/white/36.png"
    ],
    black: [
      "image/fortuner/black/2.png",
      "image/fortuner/black/4.png",
      "image/fortuner/black/8.png",
      "image/fortuner/black/16.png",
      "image/fortuner/black/19.png",
      "image/fortuner/black/24.png",
      "image/fortuner/black/36.png"
    ],
    gris: [
      "image/fortuner/gris/2.png",
      "image/fortuner/gris/4.png",
      "image/fortuner/gris/8.png",
      "image/fortuner/gris/16.png",
      "image/fortuner/gris/19.png",
      "image/fortuner/gris/24.png",
      "image/fortuner/gris/36.png"
    ]
  };

  function img(src) {
    document.querySelector('.slide').src = src;
  }

  function switchColor(color) {
    if (!document.body.classList.contains("page-fortuner")) return;
    if (!imagesFortuner[color]) return;

    let optionDiv = document.querySelector('.option');
    optionDiv.innerHTML = "";

    imagesFortuner[color].forEach(src => {
      let imgTag = document.createElement("img");
      imgTag.src = src;
      imgTag.onclick = () => img(src);
      optionDiv.appendChild(imgTag);
    });

    document.querySelector('.slide').src = imagesFortuner[color][0];
  }
  // ---------------- FORTUNER FEATURES ----------------
  const FEATURES_FORTUNER_AVANT = [
    { id:"grille", title:"Calandre Imposante", text:"Large calandre chromée donnant un look robuste et prestigieux.", pos:{top:"45%", left:"52%"} },
    { id:"phares", title:"Phares LED Hautes Performances", text:"Éclairage puissant et signature lumineuse moderne.", pos:{top:"42%", left:"66%"} },
    { id:"logo", title:"Logo Toyota avec Radar", text:"Logo central intégrant les capteurs d’assistance à la conduite.", pos:{top:"42%", left:"57%"} },
    { id:"capot", title:"Capot Musclé", text:"Capot surélevé accentuant le style SUV puissant.", pos:{top:"37%", left:"50%"} },
    { id:"antibrouillard", title:"Feux Antibrouillard LED", text:"Visibilité renforcée en toutes conditions.", pos:{top:"56%", left:"42%"} }
  ];

  const FEATURES_FORTUNER_ARRIERE = [
    { id:"feux", title:"Feux Arrière LED Modernes", text:"Nouvelle signature lumineuse horizontale distinctive.", pos:{top:"36%", left:"47%"} },
    { id:"hayon", title:"Hayon Électrique", text:"Ouverture mains libres pratique avec capteur de pied.", pos:{top:"61%", left:"31%"} },
    { id:"coffre", title:"Coffre Spacieux", text:"Volume généreux adapté aux voyages et aventures.", pos:{top:"36%", left:"31%"} },
    { id:"spoiler", title:"Spoiler Arrière Intégré", text:"Optimise l’aérodynamisme tout en renforçant le style.", pos:{top:"23%", left:"33%"} },
    { id:"parechocs_ar", title:"Pare-chocs Arrière Renforcé", text:"Robuste, idéal pour le tout-terrain et la sécurité.", pos:{top:"58%", left:"36%"} }
  ];

  const listFortuner = document.getElementById('list');
  const stageFortuner = document.getElementById('stage');
  const carImageFortuner = document.getElementById('car-image');
  const descBoxFortuner = document.getElementById('description');
  let currentFeaturesFortuner = [];

  // Affichage des points et liste
  function renderFortuner(features, imageSrc, altText) {
    listFortuner.querySelectorAll('.item').forEach(el => el.remove());
    stageFortuner.querySelectorAll('.dot').forEach(dot => dot.remove());
    carImageFortuner.src = imageSrc;
    carImageFortuner.alt = altText;

    features.forEach(f => {
      const item = document.createElement('div');
      item.className = 'item';
      item.id = 'item-fortuner-' + f.id;
      item.innerHTML = `
        <div class="head" data-target="${f.id}">
          <div>${f.title}</div>
          <span>+</span>
        </div>
        <div class="body"><p>${f.text}</p></div>
      `;
      listFortuner.appendChild(item);

      const dot = document.createElement('div');
      dot.className = 'dot';
      dot.style.top = f.pos.top;
      dot.style.left = f.pos.left;
      dot.dataset.target = f.id;
      dot.dataset.open = "false";
      stageFortuner.appendChild(dot);
    });

    descBoxFortuner.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
  }

  // Ouvrir/fermer description
  function toggleFeatureFortuner(id, features) {
    features.forEach(f => {
      const item = document.getElementById('item-fortuner-' + f.id);
      const head = item?.querySelector('.head span');
      const dot = document.querySelector(`.dot[data-target="${f.id}"]`);
      if (f.id === id) {
        const isOpen = !(item?.classList.contains('open'));
        item?.classList.toggle('open', isOpen);
        if (head) head.textContent = isOpen ? "–" : "+";
        dot.dataset.open = isOpen ? "true" : "false";
        if (window.innerWidth < 768 && isOpen) {
          descBoxFortuner.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
        }
      } else {
        item?.classList.remove('open');
        if (head) head.textContent = "+";
        dot.dataset.open = "false";
      }
    });
  }

  // INIT
  currentFeaturesFortuner = FEATURES_FORTUNER_AVANT;
  renderFortuner(currentFeaturesFortuner, "image/fortuner/black/2.png", "Fortuner Avant");

  // Boutons Avant/Arrière
  document.getElementById('btn-avant').addEventListener('click', () => {
    currentFeaturesFortuner = FEATURES_FORTUNER_AVANT;
    renderFortuner(currentFeaturesFortuner, "image/fortuner/black/2.png", "Fortuner Avant");
    document.getElementById('btn-avant').classList.add("active");
    document.getElementById('btn-arriere').classList.remove("active");
  });

  document.getElementById('btn-arriere').addEventListener('click', () => {
    currentFeaturesFortuner = FEATURES_FORTUNER_ARRIERE;
    renderFortuner(currentFeaturesFortuner, "image/fortuner/black/16.png", "Fortuner Arrière");
    document.getElementById('btn-arriere').classList.add("active");
    document.getElementById('btn-avant').classList.remove("active");
  });

  // Événements clic
  listFortuner.addEventListener('click', e => {
    const head = e.target.closest('.head');
    if (!head) return;
    toggleFeatureFortuner(head.dataset.target, currentFeaturesFortuner);
  });

  stageFortuner.addEventListener('click', e => {
    const dot = e.target.closest('.dot');
    if (!dot) return;
    toggleFeatureFortuner(dot.dataset.target, currentFeaturesFortuner);
  });
</script>

</body>
</html>
