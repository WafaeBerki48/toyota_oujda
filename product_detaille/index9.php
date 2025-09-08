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
      $about   = "message hilux simple cabine";

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
  <title>Toyota Hilux Simple Cabine</title>
  <link rel="website icon" type="svg" href="../img/icon.svg">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="page-hilux_simple_cabine">

<nav>
  <ul class="sidebar">
    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Hilux Simple Cabine</li>
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
        <img src="image/hilux_simple_cabine/white/2.jpg" class="slide">
      </div>
      <div class="option flex">
        <img src="image/hilux_simple_cabine/white/2.jpg" onclick="img('image/hilux_simple_cabine/white/2.jpg')">
        <img src="image/hilux_simple_cabine/white/4.jpg" onclick="img('image/hilux_simple_cabine/white/4.jpg')">
        <img src="image/hilux_simple_cabine/white/8.jpg" onclick="img('image/hilux_simple_cabine/white/8.jpg')">
        <img src="image/hilux_simple_cabine/white/16.jpg" onclick="img('image/hilux_simple_cabine/white/16.jpg')">
        <img src="image/hilux_simple_cabine/white/19.jpg" onclick="img('image/hilux_simple_cabine/white/19.jpg')">
        <img src="image/hilux_simple_cabine/white/24.jpg" onclick="img('image/hilux_simple_cabine/white/24.jpg')">
        <img src="image/hilux_simple_cabine/white/36.jpg" onclick="img('image/hilux_simple_cabine/white/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota Hilux Simple Cabine</h3>
      <p class="paragraphe">
        Le Hilux Simple Cabine est robuste et fiable, idéal pour le travail comme pour les trajets quotidiens. 
        Son design puissant et sa solidité en font un pick-up polyvalent et performant.
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#6b7280;" onclick="switchColor('gris')" title="Gris"></span>
        <span style="background:#9ca3af;" onclick="switchColor('gris2')" title="Gris foncé"></span>
        <span style="background:#fff; border:1px solid #ccc;" onclick="switchColor('white')" title="Blanc"></span>
        <span style="background:rgb(214, 209, 163);" onclick="switchColor('jaune')" title="Jaune"></span>
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
    <img id="car-image" src="image/hilux_simple_cabine/gris/36.jpg" alt="Voiture Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/hilux_simple_cabine.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index9.php" method="POST">
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
  // Images pour Hilux Simple Cabine
  let imagesHiluxSimple = {
    gris: [
      "image/hilux_simple_cabine/gris/2.jpg",
      "image/hilux_simple_cabine/gris/4.jpg",
      "image/hilux_simple_cabine/gris/8.jpg",
      "image/hilux_simple_cabine/gris/16.jpg",
      "image/hilux_simple_cabine/gris/19.jpg",
      "image/hilux_simple_cabine/gris/24.jpg",
      "image/hilux_simple_cabine/gris/36.jpg"
    ],
    gris2: [
      "image/hilux_simple_cabine/gris2/2.jpg",
      "image/hilux_simple_cabine/gris2/4.jpg",
      "image/hilux_simple_cabine/gris2/8.jpg",
      "image/hilux_simple_cabine/gris2/16.jpg",
      "image/hilux_simple_cabine/gris2/19.jpg",
      "image/hilux_simple_cabine/gris2/24.jpg",
      "image/hilux_simple_cabine/gris2/36.jpg"
    ],
    white: [
      "image/hilux_simple_cabine/white/2.jpg",
      "image/hilux_simple_cabine/white/4.jpg",
      "image/hilux_simple_cabine/white/8.jpg",
      "image/hilux_simple_cabine/white/16.jpg",
      "image/hilux_simple_cabine/white/19.jpg",
      "image/hilux_simple_cabine/white/24.jpg",
      "image/hilux_simple_cabine/white/36.jpg"
    ],
    jaune: [
      "image/hilux_simple_cabine/jaune/2.jpg",
      "image/hilux_simple_cabine/jaune/4.jpg",
      "image/hilux_simple_cabine/jaune/8.jpg",
      "image/hilux_simple_cabine/jaune/16.jpg",
      "image/hilux_simple_cabine/jaune/19.jpg",
      "image/hilux_simple_cabine/jaune/24.jpg",
      "image/hilux_simple_cabine/jaune/36.jpg"
    ]
  };

  function img(src) {
    document.querySelector('.slide').src = src;
  }

  function switchColor(color) {
    if (!document.body.classList.contains("page-hilux_simple_cabine")) return;
    if (!imagesHiluxSimple[color]) return;

    let optionDiv = document.querySelector('.option');
    optionDiv.innerHTML = "";

    imagesHiluxSimple[color].forEach(src => {
      let imgTag = document.createElement("img");
      imgTag.src = src;
      imgTag.onclick = () => img(src);
      optionDiv.appendChild(imgTag);
    });

    document.querySelector('.slide').src = imagesHiluxSimple[color][0];
  }
  // ---------------- CARACTÉRISTIQUES HILUX SIMPLE CABINE ----------------
  const FEATURES_HILUX_AVANT = [
    { id:"calandre", title:"Calandre Robuste", text:"Calandre imposante avec design utilitaire.", pos:{top:"47%", left:"80%"} },
    { id:"phares", title:"Phares Halogènes/LED", text:"Visibilité renforcée pour la conduite de nuit.", pos:{top:"45%", left:"63%"} },
    { id:"parechocs", title:"Pare-chocs Renforcé", text:"Protection adaptée aux environnements difficiles.", pos:{top:"65%", left:"75%"} },
    { id:"garde", title:"Garde au Sol Élevée", text:"Parfaite pour franchir routes et terrains accidentés.", pos:{top:"70%", left:"50%"} },
    { id:"retro", title:"Rétroviseurs Extérieurs", text:"Grands rétros pour une meilleure visibilité latérale.", pos:{top:"40%", left:"48%"} },
  ];

  const FEATURES_HILUX_ARRIERE = [
    { id:"benne", title:"Benne Renforcée", text:"Conçue pour transporter des charges lourdes.", pos:{top:"35%", left:"58%"} },
    { id:"feux", title:"Feux Arrière Classiques/LED", text:"Bonne visibilité en toutes conditions.", pos:{top:"50%", left:"50%"} },
    { id:"hayon", title:"Hayon Robuste", text:"Pratique pour charger et décharger facilement.", pos:{top:"50%", left:"57%"} },
    { id:"chassis", title:"Châssis Solide", text:"Résistant pour supporter les charges extrêmes.", pos:{top:"61%", left:"40%"} },
    { id:"suspension", title:"Suspension Renforcée", text:"Amortisseurs adaptés aux terrains difficiles.", pos:{top: "75%", left: "48%"} }  
  ];

  const listHilux = document.getElementById('list');
  const stageHilux = document.getElementById('stage');
  const carImageHilux = document.getElementById('car-image');
  const descBoxHilux = document.getElementById('description');
  let currentFeaturesHilux = [];

  // Affichage des points et liste
  function renderHiluxSimple(features, imageSrc, altText) {
  listHilux.querySelectorAll('.item').forEach(el => el.remove());
  stageHilux.querySelectorAll('.dot').forEach(dot => dot.remove());
  carImageHilux.src = imageSrc;
  carImageHilux.alt = altText;

  features.forEach(f => {
    const item = document.createElement('div');
    item.className = 'item';
    item.id = 'item-hilux-' + f.id;
    item.innerHTML = `
      <div class="head" data-target="${f.id}">
        <div>${f.title}</div>
        <span>+</span>
      </div>
      <div class="body"><p>${f.text}</p></div>
    `;
    listHilux.appendChild(item);

    const dot = document.createElement('div');
    dot.className = 'dot';
    dot.style.top = f.pos.top;
    dot.style.left = f.pos.left;
    dot.dataset.target = f.id;
    dot.dataset.open = "false";
    stageHilux.appendChild(dot);
  });

    descBoxHilux.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
  }

  // Ouvrir/fermer description
  function toggleFeatureHiluxSimple(id, features) {
    features.forEach(f => {
      const item = document.getElementById('item-hilux-' + f.id);
      const head = item?.querySelector('.head span');
      const dot = document.querySelector(`.dot[data-target="${f.id}"]`);
      if (f.id === id) {
        const isOpen = !(item?.classList.contains('open'));
        item?.classList.toggle('open', isOpen);
        if (head) head.textContent = isOpen ? "–" : "+";
        dot.dataset.open = isOpen ? "true" : "false";
        if (window.innerWidth < 768 && isOpen) {
          descBoxHilux.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
        }
      } else {
        item?.classList.remove('open');
        if (head) head.textContent = "+";
        dot.dataset.open = "false";
      }
    });
  }

  // INIT
  currentFeaturesHilux = FEATURES_HILUX_AVANT;
  renderHiluxSimple(currentFeaturesHilux, "image/hilux_simple_cabine/gris/36.jpg", "Hilux Avant");

  // Boutons Avant/Arrière
  document.getElementById('btn-avant').addEventListener('click', () => {
    currentFeaturesHilux = FEATURES_HILUX_AVANT;
    renderHiluxSimple(currentFeaturesHilux, "image/hilux_simple_cabine/gris/36.jpg", "Hilux Avant");
    document.getElementById('btn-avant').classList.add("active");
    document.getElementById('btn-arriere').classList.remove("active");
  });

  document.getElementById('btn-arriere').addEventListener('click', () => {
    currentFeaturesHilux = FEATURES_HILUX_ARRIERE;
    renderHiluxSimple(currentFeaturesHilux, "image/hilux_simple_cabine/gris/16.jpg", "Hilux Arrière");
    document.getElementById('btn-arriere').classList.add("active");
    document.getElementById('btn-avant').classList.remove("active");
  });

  // Événements clic
  listHilux.addEventListener('click', e => {
    const head = e.target.closest('.head');
    if (!head) return;
    toggleFeatureHiluxSimple(head.dataset.target, currentFeaturesHilux);
  });

  stageHilux.addEventListener('click', e => {
    const dot = e.target.closest('.dot');
    if (!dot) return;
    toggleFeatureHiluxSimple(dot.dataset.target, currentFeaturesHilux);
  });
</script>

</body>
</html>
