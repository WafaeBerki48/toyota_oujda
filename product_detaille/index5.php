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
      $about   = "message corola prestige";

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

<body class="page-corolla_prestige">

<nav>
  <ul class="sidebar">
    <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota Corolla Prestige</li>
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
        <img src="image/corolla_prestige/white/2.jpg" class="slide">
      </div>
      <div class="option flex">
        <img src="image/corolla_prestige/white/2.jpg" onclick="img('image/corolla_prestige/white/2.jpg')">
        <img src="image/corolla_prestige/white/4.jpg" onclick="img('image/corolla_prestige/white/4.jpg')">
        <img src="image/corolla_prestige/white/8.jpg" onclick="img('image/corolla_prestige/white/8.jpg')">
        <img src="image/corolla_prestige/white/16.jpg" onclick="img('image/corolla_prestige/white/16.jpg')">
        <img src="image/corolla_prestige/white/19.jpg" onclick="img('image/corolla_prestige/white/19.jpg')">
        <img src="image/corolla_prestige/white/24.jpg" onclick="img('image/corolla_prestige/white/24.jpg')">
        <img src="image/corolla_prestige/white/36.jpg" onclick="img('image/corolla_prestige/white/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota Corolla Prestige</h3>
      <p class="paragraphe">
         La Toyota Corolla Prestige allie élégance, confort et performances modernes. 
         Elle offre une conduite fluide, une sécurité optimale et des technologies avancées pour rendre chaque trajet agréable.
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#000;" onclick="switchColor('black')" title="Noir"></span>
        <span style="background:#9ca3af;" onclick="switchColor('gris')" title="Gris"></span>
        <span style="background:#5f6d7a;" onclick="switchColor('gris_bleu')" title="Gris Bleu"></span>
        <span style="background:#800000;" onclick="switchColor('maron')" title="Marron"></span>
        <span style="background:#fff; border:1px solid #ccc;" onclick="switchColor('white')" title="Blanc"></span>
      </div>
    </div>
  </div>
</section>

<div class="wrap" id="caracteristiques">
  <aside class="panel" id="list-prestige">
    <div class="tabs">
      <button id="btn-avant-prestige" class="active">Avant</button>
      <button id="btn-arriere-prestige">Arrière</button>
    </div>
  </aside>

  <section class="stage" id="stage-prestige">
    <img id="car-image-prestige" src="image/corolla_prestige/black/2.jpg" alt="Corolla Prestige Avant">
  </section>
</div>

<div class="description-box" id="description-prestige">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>


<a href="pdf/corolla_prestige.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index5.php" method="POST">
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
  // Images pour Corolla Prestige
  let imagesCorollaPrestige = {
    white: [
      "image/corolla_prestige/white/2.jpg",
      "image/corolla_prestige/white/4.jpg",
      "image/corolla_prestige/white/8.jpg",
      "image/corolla_prestige/white/16.jpg",
      "image/corolla_prestige/white/19.jpg",
      "image/corolla_prestige/white/24.jpg",
      "image/corolla_prestige/white/36.jpg"
    ],
    black: [
      "image/corolla_prestige/black/2.jpg",
      "image/corolla_prestige/black/4.jpg",
      "image/corolla_prestige/black/8.jpg",
      "image/corolla_prestige/black/16.jpg",
      "image/corolla_prestige/black/19.jpg",
      "image/corolla_prestige/black/24.jpg",
      "image/corolla_prestige/black/36.jpg"
    ],
    gris: [
      "image/corolla_prestige/gris/2.jpg",
      "image/corolla_prestige/gris/4.jpg",
      "image/corolla_prestige/gris/8.jpg",
      "image/corolla_prestige/gris/16.jpg",
      "image/corolla_prestige/gris/19.jpg",
      "image/corolla_prestige/gris/24.jpg",
      "image/corolla_prestige/gris/36.jpg"
    ],
    gris_bleu: [
      "image/corolla_prestige/gris_bleu/2.jpg",
      "image/corolla_prestige/gris_bleu/4.jpg",
      "image/corolla_prestige/gris_bleu/8.jpg",
      "image/corolla_prestige/gris_bleu/16.jpg",
      "image/corolla_prestige/gris_bleu/19.jpg",
      "image/corolla_prestige/gris_bleu/24.jpg",
      "image/corolla_prestige/gris_bleu/36.jpg"
    ],
    maron: [
      "image/corolla_prestige/maron/2.jpg",
      "image/corolla_prestige/maron/4.jpg",
      "image/corolla_prestige/maron/8.jpg",
      "image/corolla_prestige/maron/16.jpg",
      "image/corolla_prestige/maron/19.jpg",
      "image/corolla_prestige/maron/24.jpg",
      "image/corolla_prestige/maron/36.jpg"
    ]
  };

  function img(src) {
    document.querySelector('.slide').src = src;
  }

  function switchColor(color) {
    if (!document.body.classList.contains("page-corolla_prestige")) return;
    if (!imagesCorollaPrestige[color]) return;

    let optionDiv = document.querySelector('.option');
    optionDiv.innerHTML = "";

    imagesCorollaPrestige[color].forEach(src => {
      let imgTag = document.createElement("img");
      imgTag.src = src;
      imgTag.onclick = () => img(src);
      optionDiv.appendChild(imgTag);
    });

    document.querySelector('.slide').src = imagesCorollaPrestige[color][0];
  }
  // ---------------- FEATURES COROLLA PRESTIGE ----------------
  const FEATURES_PRESTIGE_AVANT = [
    { id:"grille", title:"Finition Calandre Premium", text:"Calandre élégante avec détails chromés pour un look raffiné.", pos:{top:"62%", left:"50%"} },
    { id:"phares", title:"Éclairage Intelligent LED", text:"Phares adaptatifs LED pour une visibilité optimale et un design moderne.", pos:{top:"48%", left:"69%"} },
    { id:"logo", title:"Emblème Prestige Toyota", text:"Logo central avec finition brillante, symbole de luxe et de qualité.", pos:{top:"60%", left:"63%"} },
    { id:"parechocs", title:"Bouclier Avant Raffiné", text:"Pare-chocs stylé et robuste pour une allure premium.", pos:{top:"70%", left:"55%"} },
    { id:"feux_diurnes", title:"Feux de Jour Signature", text:"Feux diurnes LED distinctifs pour un style unique.", pos:{top:"63%", left:"41%"} }
  ];
  const FEATURES_PRESTIGE_ARRIERE = [
    { id:"feux_arriere", title:"Signature Lumineuse Arrière", text:"Feux arrière LED au design exclusif pour un look sophistiqué.", pos:{top:"42%", left:"26%"} },
    { id:"hayon", title:"Hayon Automatique Mains Libres", text:"Hayon électrique avec ouverture pratique sans les mains.", pos:{top:"67%", left:"34%"} },
    { id:"lunette", title:"Lunette Arrière Premium", text:"Lunette arrière avec essuie-glace intégré et finition élégante.", pos:{top:"32%", left:"35%"} },
    { id:"spoiler", title:"Spoiler Élégant", text:"Spoiler arrière stylisé qui complète le design haut de gamme.", pos:{top:"29%", left:"42%"} },
    { id:"parechocs_ar", title:"Bouclier Arrière Renforcé", text:"Pare-chocs arrière solide avec une finition raffinée.", pos:{top:"60%", left:"43%"} }
  ];

  const listPrestige = document.getElementById('list-prestige');
  const stagePrestige = document.getElementById('stage-prestige');
  const carImagePrestige = document.getElementById('car-image-prestige');
  const descBoxPrestige = document.getElementById('description-prestige');
  let currentFeaturesPrestige = [];

  function renderPrestige(features, imageSrc, altText) {
    listPrestige.querySelectorAll('.item').forEach(el => el.remove());
    stagePrestige.querySelectorAll('.dot').forEach(dot => dot.remove());
    carImagePrestige.src = imageSrc;
    carImagePrestige.alt = altText;

    features.forEach(f => {
      const item = document.createElement('div');
      item.className = 'item';
      item.id = 'item-prestige-' + f.id;
      item.innerHTML = `
        <div class="head" data-target="${f.id}">
          <div>${f.title}</div>
          <span>+</span>
        </div>
        <div class="body"><p>${f.text}</p></div>
      `;
      listPrestige.appendChild(item);

      const dot = document.createElement('div');
      dot.className = 'dot';
      dot.style.top = f.pos.top;
      dot.style.left = f.pos.left;
      dot.dataset.target = f.id;
      dot.dataset.open = "false";
      stagePrestige.appendChild(dot);
    });

    descBoxPrestige.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
  }

  function toggleFeaturePrestige(id, features) {
    features.forEach(f => {
      const item = document.getElementById('item-prestige-' + f.id);
      const head = item?.querySelector('.head span');
      const dot = document.querySelector(`#stage-prestige .dot[data-target="${f.id}"]`);
      if (f.id === id) {
        const isOpen = !(item?.classList.contains('open'));
        item?.classList.toggle('open', isOpen);
        if (head) head.textContent = isOpen ? "–" : "+";
        dot.dataset.open = isOpen ? "true" : "false";
        if (window.innerWidth < 768 && isOpen) {
          descBoxPrestige.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
        }
      } else {
        item?.classList.remove('open');
        if (head) head.textContent = "+";
        dot.dataset.open = "false";
      }
    });
  }

  // ---------------- INIT ----------------
  currentFeaturesPrestige = FEATURES_PRESTIGE_AVANT;
  renderPrestige(currentFeaturesPrestige, "image/corolla_prestige/black/2.jpg", "Corolla Prestige Avant");

  document.getElementById('btn-avant-prestige').addEventListener('click', () => {
    currentFeaturesPrestige = FEATURES_PRESTIGE_AVANT;
    renderPrestige(currentFeaturesPrestige, "image/corolla_prestige/black/2.jpg", "Corolla Prestige Avant");
    document.getElementById('btn-avant-prestige').classList.add("active");
    document.getElementById('btn-arriere-prestige').classList.remove("active");
  });

  document.getElementById('btn-arriere-prestige').addEventListener('click', () => {
    currentFeaturesPrestige = FEATURES_PRESTIGE_ARRIERE;
    renderPrestige(currentFeaturesPrestige, "image/corolla_prestige/black/16.jpg", "Corolla Prestige Arrière");
    document.getElementById('btn-arriere-prestige').classList.add("active");
    document.getElementById('btn-avant-prestige').classList.remove("active");
  });

  // ---------------- EVENTS ----------------
  listPrestige.addEventListener('click', e => {
    const head = e.target.closest('.head');
    if (!head) return;
    toggleFeaturePrestige(head.dataset.target, currentFeaturesPrestige);
  });

  stagePrestige.addEventListener('click', e => {
    const dot = e.target.closest('.dot');
    if (!dot) return;
    toggleFeaturePrestige(dot.dataset.target, currentFeaturesPrestige);
  });

</script>

</body>
</html>
