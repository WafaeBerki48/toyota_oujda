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
      $about   = "message Rav4";

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

<body class="page-rav4">

<nav>
  <ul class="sidebar">
    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota RAV4</li>
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
        <img src="image/rav4/white/2.jpg" class="slide">
      </div>
      <div class="option flex">
        <img src="image/rav4/white/2.jpg" onclick="img('image/rav4/white/2.jpg')">
        <img src="image/rav4/white/4.jpg" onclick="img('image/rav4/white/4.jpg')">
        <img src="image/rav4/white/8.jpg" onclick="img('image/rav4/white/8.jpg')">
        <img src="image/rav4/white/16.jpg" onclick="img('image/rav4/white/16.jpg')">
        <img src="image/rav4/white/19.jpg" onclick="img('image/rav4/white/19.jpg')">
        <img src="image/rav4/white/24.jpg" onclick="img('image/rav4/white/24.jpg')">
        <img src="image/rav4/white/36.jpg" onclick="img('image/rav4/white/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota RAV4</h3>
      <p class="paragraphe">
        Le Toyota RAV4 allie robustesse et confort pour tous types de trajets. 
        Avec ses technologies avancées, sa sécurité optimale et son design moderne, il offre une expérience de conduite polyvalente et agréable.
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#474646ff;" onclick="switchColor('black')" title="Noir"></span>
        <span style="background:#182664;" onclick="switchColor('bleu')" title="Bleu"></span>
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
    <img id="car-image" src="image/rav4/black/2.jpg" alt="Voiture Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/Rav4.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index7.php" method="POST">
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
  // Images pour RAV4
  let imagesRav4 = {
    white: [
      "image/rav4/white/2.jpg",
      "image/rav4/white/4.jpg",
      "image/rav4/white/8.jpg",
      "image/rav4/white/16.jpg",
      "image/rav4/white/19.jpg",
      "image/rav4/white/24.jpg",
      "image/rav4/white/36.jpg"
    ],
    black: [
      "image/rav4/black/2.jpg",
      "image/rav4/black/4.jpg",
      "image/rav4/black/8.jpg",
      "image/rav4/black/16.jpg",
      "image/rav4/black/19.jpg",
      "image/rav4/black/24.jpg",
      "image/rav4/black/36.jpg"
    ],
    bleu: [
      "image/rav4/bleu/2.jpg",
      "image/rav4/bleu/4.jpg",
      "image/rav4/bleu/8.jpg",
      "image/rav4/bleu/16.jpg",
      "image/rav4/bleu/19.jpg",
      "image/rav4/bleu/24.jpg",
      "image/rav4/bleu/36.jpg"
    ],
    gris: [
      "image/rav4/gris/2.jpg",
      "image/rav4/gris/4.jpg",
      "image/rav4/gris/8.jpg",
      "image/rav4/gris/16.jpg",
      "image/rav4/gris/19.jpg",
      "image/rav4/gris/24.jpg",
      "image/rav4/gris/36.jpg"
    ]
  };

  function img(src) {
    document.querySelector('.slide').src = src;
  }

  function switchColor(color) {
    if (!document.body.classList.contains("page-rav4")) return;
    if (!imagesRav4[color]) return;

    let optionDiv = document.querySelector('.option');
    optionDiv.innerHTML = "";

    imagesRav4[color].forEach(src => {
      let imgTag = document.createElement("img");
      imgTag.src = src;
      imgTag.onclick = () => img(src);
      optionDiv.appendChild(imgTag);
    });

    document.querySelector('.slide').src = imagesRav4[color][0];
  }
  // ---------------- RAV4 FEATURES ----------------
  const FEATURES_RAV4_AVANT = [
    { id:"grille", title:"Calandre Imposante", text:"Calandre large et robuste avec design SUV affirmé.", pos:{top:"49%", left:"50%"} },
    { id:"phares", title:"Phares LED Bi-Projecteurs", text:"Phares LED avec signature lumineuse unique Toyota.", pos:{top:"45%", left:"67%"} },
    { id:"logo", title:"Logo Toyota Central", text:"Logo intégré avec capteur radar pour aides à la conduite.", pos:{top:"57%", left:"59%"} },
    { id:"parechocs", title:"Pare-chocs Avant Sculpté", text:"Pare-chocs robuste offrant style et protection.", pos:{top:"65%", left:"50%"} },
    { id:"antibrouillard", title:"Feux Antibrouillard LED", text:"Meilleure visibilité en toutes conditions.", pos:{top:"56%", left:"41%"} }
  ];

  const FEATURES_RAV4_ARRIERE = [
    { id:"feux", title:"Feux Arrière LED 3D", text:"Nouvelle signature lumineuse moderne et distinctive.", pos:{top:"39%", left:"26%"} },
    { id:"hayon", title:"Hayon Électrique Mains Libres", text:"Ouverture facile avec capteur de mouvement.", pos:{top:"65%", left:"35%"} },
    { id:"lunette", title:"Lunette Arrière Teintée", text:"Protection solaire et confort visuel.", pos:{top:"32%", left:"36%"} },
    { id:"spoiler", title:"Spoiler Sport Intégré", text:"Optimise l’aérodynamisme et le style du SUV.", pos:{top:"28%", left:"42%"} },
    { id:"parechocs_ar", title:"Pare-chocs Arrière Renforcé", text:"Protection supplémentaire et design robuste.", pos:{top:"60%", left:"39%"} }
  ];

  const listRav4 = document.getElementById('list');
  const stageRav4 = document.getElementById('stage');
  const carImageRav4 = document.getElementById('car-image');
  const descBoxRav4 = document.getElementById('description');
  let currentFeaturesRav4 = [];

  // Affichage des points et liste
  function renderRav4(features, imageSrc, altText) {
    listRav4.querySelectorAll('.item').forEach(el => el.remove());
    stageRav4.querySelectorAll('.dot').forEach(dot => dot.remove());
    carImageRav4.src = imageSrc;
    carImageRav4.alt = altText;

    features.forEach(f => {
      const item = document.createElement('div');
      item.className = 'item';
      item.id = 'item-rav4-' + f.id;
      item.innerHTML = `
        <div class="head" data-target="${f.id}">
          <div>${f.title}</div>
          <span>+</span>
        </div>
        <div class="body"><p>${f.text}</p></div>
      `;
      listRav4.appendChild(item);

      const dot = document.createElement('div');
      dot.className = 'dot';
      dot.style.top = f.pos.top;
      dot.style.left = f.pos.left;
      dot.dataset.target = f.id;
      dot.dataset.open = "false";
      stageRav4.appendChild(dot);
    });

    descBoxRav4.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
  }

  // Ouvrir/fermer description
  function toggleFeatureRav4(id, features) {
    features.forEach(f => {
      const item = document.getElementById('item-rav4-' + f.id);
      const head = item?.querySelector('.head span');
      const dot = document.querySelector(`.dot[data-target="${f.id}"]`);
      if (f.id === id) {
        const isOpen = !(item?.classList.contains('open'));
        item?.classList.toggle('open', isOpen);
        if (head) head.textContent = isOpen ? "–" : "+";
        dot.dataset.open = isOpen ? "true" : "false";
        if (window.innerWidth < 768 && isOpen) {
          descBoxRav4.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
        }
      } else {
        item?.classList.remove('open');
        if (head) head.textContent = "+";
        dot.dataset.open = "false";
      }
    });
  }

  // INIT
  currentFeaturesRav4 = FEATURES_RAV4_AVANT;
  renderRav4(currentFeaturesRav4, "image/rav4/black/2.jpg", "RAV4 Avant");

  // Boutons Avant/Arrière
  document.getElementById('btn-avant').addEventListener('click', () => {
    currentFeaturesRav4 = FEATURES_RAV4_AVANT;
    renderRav4(currentFeaturesRav4, "image/rav4/black/2.jpg", "RAV4 Avant");
    document.getElementById('btn-avant').classList.add("active");
    document.getElementById('btn-arriere').classList.remove("active");
  });

  document.getElementById('btn-arriere').addEventListener('click', () => {
    currentFeaturesRav4 = FEATURES_RAV4_ARRIERE;
    renderRav4(currentFeaturesRav4, "image/rav4/black/16.jpg", "RAV4 Arrière");
    document.getElementById('btn-arriere').classList.add("active");
    document.getElementById('btn-avant').classList.remove("active");
  });

  // Événements clic
  listRav4.addEventListener('click', e => {
    const head = e.target.closest('.head');
    if (!head) return;
    toggleFeatureRav4(head.dataset.target, currentFeaturesRav4);
  });

  stageRav4.addEventListener('click', e => {
    const dot = e.target.closest('.dot');
    if (!dot) return;
    toggleFeatureRav4(dot.dataset.target, currentFeaturesRav4);
  });

</script>

</body>
</html>
