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
      $about   = "message corola x";

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

<body class="page-corolla_x">

<nav>
  <ul class="sidebar">
    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota Corolla X SUV</li>
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
        <img src="image/corolla_x/white/2.png" class="slide">
      </div>
      <div class="option flex">
        <img src="image/corolla_x/white/2.png" onclick="img('image/corolla_x/white/2.png')">
        <img src="image/corolla_x/white/4.png" onclick="img('image/corolla_x/white/4.png')">
        <img src="image/corolla_x/white/8.png" onclick="img('image/corolla_x/white/8.png')">
        <img src="image/corolla_x/white/16.png" onclick="img('image/corolla_x/white/16.png')">
        <img src="image/corolla_x/white/19.png" onclick="img('image/corolla_x/white/19.png')">
        <img src="image/corolla_x/white/24.png" onclick="img('image/corolla_x/white/24.png')">
        <img src="image/corolla_x/white/36.png" onclick="img('image/corolla_x/white/36.png')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota Corolla X SUV</h3>
      <p class="paragraphe">
         La Toyota Corolla X SUV combine robustesse, confort et design moderne. 
         Adaptée pour la ville et les routes plus longues, elle offre sécurité, performance et technologies avancées pour une expérience de conduite optimale.
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#000;" onclick="switchColor('black')" title="Noir"></span>
        <span style="background:#9ca3af;" onclick="switchColor('gris')" title="Gris"></span>
        <span style="background:#555555;" onclick="switchColor('gris_foncé')" title="Gris foncé"></span>
        <span style="background:#dc2626;" onclick="switchColor('red')" title="Rouge"></span>
        <span style="background:#fff; border:1px solid #ccc;" onclick="switchColor('white')" title="Blanc"></span>
      </div>
    </div>
  </div>
</section>

<!-- CARACTÉRISTIQUES INTERACTIVES -->
<div class="wrap" id="caracteristiques">
  <aside class="panel" id="list-x">
    <div class="tabs">
      <button id="btn-avant-x" class="active">Avant</button>
      <button id="btn-arriere-x">Arrière</button>
    </div>
  </aside>

  <section class="stage" id="stage-x">
    <img id="car-image-x" src="image/corolla_x/black/2.png" alt="Corolla X Avant">
  </section>
</div>

<div class="description-box" id="description-x">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>
<a href="pdf/corolla_x.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index6.php" method="POST">
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
  // Images pour Corolla X SUV
let imagesCorollaX = {
  white: [
    "image/corolla_x/white/2.png",
    "image/corolla_x/white/4.png",
    "image/corolla_x/white/8.png",
    "image/corolla_x/white/16.png",
    "image/corolla_x/white/19.png",
    "image/corolla_x/white/24.png",
    "image/corolla_x/white/36.png"
  ],
  black: [
    "image/corolla_x/black/2.png",
    "image/corolla_x/black/4.png",
    "image/corolla_x/black/8.png",
    "image/corolla_x/black/16.png",
    "image/corolla_x/black/19.png",
    "image/corolla_x/black/24.png",
    "image/corolla_x/black/36.png"
  ],
  gris: [
    "image/corolla_x/gris/2.png",
    "image/corolla_x/gris/4.png",
    "image/corolla_x/gris/8.png",
    "image/corolla_x/gris/16.png",
    "image/corolla_x/gris/19.png",
    "image/corolla_x/gris/24.png",
    "image/corolla_x/gris/36.png"
  ],
  gris_foncé: [
    "image/corolla_x/gris_foncé/2.png",
    "image/corolla_x/gris_foncé/4.png",
    "image/corolla_x/gris_foncé/8.png",
    "image/corolla_x/gris_foncé/16.png",
    "image/corolla_x/gris_foncé/19.png",
    "image/corolla_x/gris_foncé/24.png",
    "image/corolla_x/gris_foncé/36.png"
  ],
  red: [
    "image/corolla_x/red/2.png",
    "image/corolla_x/red/4.png",
    "image/corolla_x/red/8.png",
    "image/corolla_x/red/16.png",
    "image/corolla_x/red/19.png",
    "image/corolla_x/red/24.png",
    "image/corolla_x/red/36.png"
  ]
};

  function img(src) {
    document.querySelector('.slide').src = src;
  }

  function switchColor(color) {
    if (!document.body.classList.contains("page-corolla_x")) return;
    if (!imagesCorollaX[color]) return;

    let optionDiv = document.querySelector('.option');
    optionDiv.innerHTML = "";

    imagesCorollaX[color].forEach(src => {
      let imgTag = document.createElement("img");
      imgTag.src = src;
      imgTag.onclick = () => img(src);
      optionDiv.appendChild(imgTag);
    });

    document.querySelector('.slide').src = imagesCorollaX[color][0];
  }


   // ---------------- FEATURES COROLLA X ----------------
  const FEATURES_X_AVANT = [
    { id:"grille", title:"Calandre Robuste", text:"Calandre imposante pour une allure SUV affirmée et protection renforcée.", pos:{top:"53%", left:"54%"} },
    { id:"phares", title:"Phares LED Dynamiques", text:"Phares LED avec signature lumineuse moderne pour visibilité optimale.", pos:{top:"45%", left:"35%"} },
    { id:"logo", title:"Emblème Central Toyota", text:"Logo bien en évidence pour une identité marquée et élégante.", pos:{top:"60%", left:"49%"} },
    { id:"parechocs", title:"Pare-chocs Avant Renforcé", text:"Pare-chocs robuste intégrant design et sécurité pour les routes urbaines et longues.", pos:{top:"66%", left:"42%"} },
    { id:"antibrouillard", title:"Feux Anti-Brouillard LED", text:"Feux stylisés pour une conduite sécurisée dans toutes les conditions.", pos:{top:"62%", left:"57%"} }
  ];
  const FEATURES_X_ARRIERE = [
    { id:"feux", title:"Feux Arrière Signature LED", text:"Design lumineux distinctif pour un look moderne et urbain.", pos:{top:"39%", left:"25%"} },
    { id:"hayon", title:"Hayon Électrique SUV", text:"Hayon pratique avec ouverture mains libres et système automatique.", pos:{top:"62%", left:"30%"} },
    { id:"lunette", title:"Lunette Arrière Protectrice", text:"Avec essuie-glace intégré pour confort et sécurité.", pos:{top:"32%", left:"34%"} },
    { id:"spoiler", title:"Spoiler Arrière Stylé", text:"Spoiler intégré au design robuste du SUV.", pos:{top:"27%", left:"40%"} },
    { id:"parechocs_ar", title:"Pare-chocs Arrière Renforcé", text:"Protection renforcée avec finition moderne pour l’arrière du véhicule.", pos:{top:"58%", left:"40%"} }
  ];

  const listX = document.getElementById('list-x');
  const stageX = document.getElementById('stage-x');
  const carImageX = document.getElementById('car-image-x');
  const descBoxX = document.getElementById('description-x');
  let currentFeaturesX = [];

  function renderX(features, imageSrc, altText) {
    listX.querySelectorAll('.item').forEach(el => el.remove());
    stageX.querySelectorAll('.dot').forEach(dot => dot.remove());
    carImageX.src = imageSrc;
    carImageX.alt = altText;

    features.forEach(f => {
      const item = document.createElement('div');
      item.className = 'item';
      item.id = 'item-x-' + f.id;
      item.innerHTML = `
        <div class="head" data-target="${f.id}">
          <div>${f.title}</div>
          <span>+</span>
        </div>
        <div class="body"><p>${f.text}</p></div>
      `;
      listX.appendChild(item);

      const dot = document.createElement('div');
      dot.className = 'dot';
      dot.style.top = f.pos.top;
      dot.style.left = f.pos.left;
      dot.dataset.target = f.id;
      dot.dataset.open = "false";
      stageX.appendChild(dot);
    });

    descBoxX.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
  }

  function toggleFeatureX(id, features) {
    features.forEach(f => {
      const item = document.getElementById('item-x-' + f.id);
      const head = item?.querySelector('.head span');
      const dot = document.querySelector(`#stage-x .dot[data-target="${f.id}"]`);
      if (f.id === id) {
        const isOpen = !(item?.classList.contains('open'));
        item?.classList.toggle('open', isOpen);
        if (head) head.textContent = isOpen ? "–" : "+";
        dot.dataset.open = isOpen ? "true" : "false";
        if (window.innerWidth < 768 && isOpen) {
          descBoxX.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
        }
      } else {
        item?.classList.remove('open');
        if (head) head.textContent = "+";
        dot.dataset.open = "false";
      }
    });
  }

  // ---------------- INIT ----------------
  currentFeaturesX = FEATURES_X_AVANT;
  renderX(currentFeaturesX, "image/corolla_x/black/2.png", "Corolla X Avant");

  document.getElementById('btn-avant-x').addEventListener('click', () => {
    currentFeaturesX = FEATURES_X_AVANT;
    renderX(currentFeaturesX, "image/corolla_x/black/2.png", "Corolla X Avant");
    document.getElementById('btn-avant-x').classList.add("active");
    document.getElementById('btn-arriere-x').classList.remove("active");
  });

  document.getElementById('btn-arriere-x').addEventListener('click', () => {
    currentFeaturesX = FEATURES_X_ARRIERE;
    renderX(currentFeaturesX, "image/corolla_x/black/36.png", "Corolla X Arrière");
    document.getElementById('btn-arriere-x').classList.add("active");
    document.getElementById('btn-avant-x').classList.remove("active");
  });

  // ---------------- EVENTS ----------------
  listX.addEventListener('click', e => {
    const head = e.target.closest('.head');
    if (!head) return;
    toggleFeatureX(head.dataset.target, currentFeaturesX);
  });

  stageX.addEventListener('click', e => {
    const dot = e.target.closest('.dot');
    if (!dot) return;
    toggleFeatureX(dot.dataset.target, currentFeaturesX);
  });
</script>

</body>
</html>
