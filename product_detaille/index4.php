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
      $about   = "message corola sport";

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
<body class="page_corola_s">

<nav>
  <ul class="sidebar">
    <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota corolla sport</li>
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
        <img src="image/corola_s/white/2.jpg" class="slide">
      </div>
      <!-- miniatures -->
      <div class="option flex">
        <img src="image/corola_s/white/4.jpg" onclick="img('image/corola_s/white/4.jpg')">
        <img src="image/corola_s/white/8.jpg" onclick="img('image/corola_s/white/8.jpg')">
        <img src="image/corola_s/white/16.jpg" onclick="img('image/corola_s/white/16.jpg')">
        <img src="image/corola_s/white/19.jpg" onclick="img('image/corola_s/white/19.jpg')">
        <img src="image/corola_s/white/24.jpg" onclick="img('image/corola_s/white/24.jpg')">
        <img src="image/corola_s/white/36.jpg" onclick="img('image/corola_s/white/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota corolla sport </h3>
      <p class="paragraphe">
        La Toyota Corolla Sport allie élégance et performance avec son design athlétique 
        et ses lignes dynamiques. Équipée d’une motorisation hybride efficiente et de 
        technologies avancées, elle offre une conduite à la fois sportive et économique. 
        Son intérieur moderne et spacieux garantit confort et connectivité pour un plaisir 
        de conduite au quotidien comme sur longs trajets.
      </p>
      <h5>Available Colors</h5>
      <div class="color flex1">
        <span style="background:#000;" onclick="switchColor('black')"></span> 
        <span style="background:#36508a;" onclick="switchColor('bleu')"></span> 
        <span style="background:#4e594dbb;" onclick="switchColor('bronze')"></span> 
        <span style="background:#9ca3af;" onclick="switchColor('gris')"></span> 
        <span style="background: linear-gradient(135deg, #800000ff, #000000);" onclick="switchColor('grona')"></span> 
        <span style="background:#8b4513;" onclick="switchColor('maron')"></span> 
        <span style="background: linear-gradient(135deg, #800000ff, #878282ff);" onclick="switchColor('red')"></span> 
        <span style="background:#fff; border:1px solid #ccc;" onclick="switchColor('white')"></span> 
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
    <img id="car-image" src="image/corola_s/black/36.jpg" alt="Voiture Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/corolla_s_pdf.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index4.php" method="POST">
      <?php if(isset($formMessage)) { echo '<p class="form-message">'.$formMessage.'</p>'; } ?>
      <input type="text" name="name" placeholder="Nom" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Téléphone" required>
      <textarea name="message" rows="3" placeholder="Message" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
</div>
<script src="js/app.js"></script>
<script>
  // ---------------- Vérification de la page ----------------
  if (document.body.classList.contains("page_corola_s")) {

    // ---------------- IMAGES SELON COULEUR ----------------
    const imagesCorolaS = {
      white:  ["image/corola_s/white/2.jpg","image/corola_s/white/4.jpg","image/corola_s/white/8.jpg","image/corola_s/white/16.jpg","image/corola_s/white/19.jpg","image/corola_s/white/24.jpg","image/corola_s/white/36.jpg"],
      black:  ["image/corola_s/black/2.jpg","image/corola_s/black/4.jpg","image/corola_s/black/8.jpg","image/corola_s/black/16.jpg","image/corola_s/black/19.jpg","image/corola_s/black/24.jpg","image/corola_s/black/36.jpg"],
      bleu:   ["image/corola_s/bleu/2.jpg","image/corola_s/bleu/4.jpg","image/corola_s/bleu/8.jpg","image/corola_s/bleu/16.jpg","image/corola_s/bleu/19.jpg","image/corola_s/bleu/24.jpg","image/corola_s/bleu/36.jpg"],
      bronze: ["image/corola_s/bronze/2.jpg","image/corola_s/bronze/4.jpg","image/corola_s/bronze/8.jpg","image/corola_s/bronze/16.jpg","image/corola_s/bronze/19.jpg","image/corola_s/bronze/24.jpg","image/corola_s/bronze/36.jpg"],
      gris:   ["image/corola_s/gris/2.jpg","image/corola_s/gris/4.jpg","image/corola_s/gris/8.jpg","image/corola_s/gris/16.jpg","image/corola_s/gris/19.jpg","image/corola_s/gris/24.jpg","image/corola_s/gris/36.jpg"],
      grona:  ["image/corola_s/grona/2.jpg","image/corola_s/grona/4.jpg","image/corola_s/grona/8.jpg","image/corola_s/grona/16.jpg","image/corola_s/grona/19.jpg","image/corola_s/grona/24.jpg","image/corola_s/grona/36.jpg"],
      maron:  ["image/corola_s/maron/2.jpg","image/corola_s/maron/4.jpg","image/corola_s/maron/8.jpg","image/corola_s/maron/16.jpg","image/corola_s/maron/19.jpg","image/corola_s/maron/24.jpg","image/corola_s/maron/36.jpg"],
      red:    ["image/corola_s/red/2.jpg","image/corola_s/red/4.jpg","image/corola_s/red/8.jpg","image/corola_s/red/16.jpg","image/corola_s/red/19.jpg","image/corola_s/red/24.jpg","image/corola_s/red/36.jpg"]
    };

    // ---------------- SLIDER PRINCIPAL ----------------
    function img(src) {
      document.querySelector('.slide').src = src;
    }

    function switchColor(color) {
      if (!imagesCorolaS[color]) {
        console.error("Couleur non trouvée :", color);
        return;
      }

      // Vider les miniatures
      let optionDiv = document.querySelector('.option');
      optionDiv.innerHTML = "";

      // Ajouter les nouvelles miniatures
      imagesCorolaS[color].forEach(src => {
        let imgTag = document.createElement("img");
        imgTag.src = src;
        imgTag.onclick = () => img(src);
        optionDiv.appendChild(imgTag);
      });

      // Afficher la première image
      document.querySelector('.slide').src = imagesCorolaS[color][0];
    }

    // ---------------- FEATURES ----------------
    const FEATURES_COROLLA_AVANT = [
      { id: "grille", title: "Calandre Sportive", text: "Forme dynamique et aérodynamique qui souligne la personnalité du véhicule.", pos: {top:"61%", left:"35%"} },
      { id: "phares", title: "Phares LED", text: "Technologie LED ultra-lumineuse pour une visibilité optimale de nuit.", pos: {top:"47%", left:"32%"} },
      { id: "logo", title: "Logo Toyota", text: "Logo central élégant, symbole d’authenticité et de performance.", pos: {top:"59%", left:"47%"} },
      { id: "parechocs", title: "Pare-chocs Avant", text: "Design robuste et fluide pour un look sportif et protection renforcée.", pos: {top:"68%", left:"49%"} },
      { id: "antibrouillard", title: "Antibrouillard LED", text: "Éclairage précis pour plus de sécurité par mauvais temps.", pos: {top:"59%", left:"59%"} }
    ];

    const FEATURES_COROLLA_ARRIERE = [
      { id: "feux", title: "Feux Arrière LED", text: "Signature lumineuse unique pour un style reconnaissable immédiatement.", pos: {top:"42%", left:"36%"} },
      { id: "hayon", title: "Hayon Électrique", text: "Ouverture mains libres, pratique et moderne.", pos: {top:"68%", left:"50%"} },
      { id: "lunette", title: "Lunette Arrière", text: "Large surface vitrée pour une meilleure visibilité et style raffiné.", pos: {top:"35%", left:"51%"} },
      { id: "spoiler", title: "Spoiler Sport", text: "Améliore l’aérodynamisme tout en ajoutant une touche sportive.", pos: {top:"29%", left:"56%"} },
      { id: "parechocs_ar", title: "Pare-chocs Arrière", text: "Robuste et stylisé pour sécurité et design harmonieux.", pos: {top:"61%", left:"43%"} }
    ];
    const listCorolla = document.getElementById('list');
    const stageCorolla = document.getElementById('stage');
    const carImageCorolla = document.getElementById('car-image');
    const descBoxCorolla = document.getElementById('description');
    let currentFeaturesCorolla = [];

    function renderCorolla(features, imageSrc, altText) {
      listCorolla.querySelectorAll('.item').forEach(el => el.remove());
      stageCorolla.querySelectorAll('.dot').forEach(dot => dot.remove());
      carImageCorolla.src = imageSrc;
      carImageCorolla.alt = altText;

      features.forEach(f => {
        const item = document.createElement('div');
        item.className = 'item';
        item.id = 'item-' + f.id;
        item.innerHTML = `
          <div class="head" data-target="${f.id}">
            <div>${f.title}</div>
            <span>+</span>
          </div>
          <div class="body"><p>${f.text}</p></div>
        `;
        listCorolla.appendChild(item);

        const dot = document.createElement('div');
        dot.className = 'dot';
        dot.style.top = f.pos.top;
        dot.style.left = f.pos.left;
        dot.dataset.target = f.id;
        dot.dataset.open = "false";
        stageCorolla.appendChild(dot);
      });

      descBoxCorolla.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
    }

    function toggleFeatureCorolla(id, features) {
      features.forEach(f => {
        const item = document.getElementById('item-' + f.id);
        const head = item?.querySelector('.head span');
        const dot = document.querySelector(`.dot[data-target="${f.id}"]`);
        if (f.id === id) {
          const isOpen = !(item?.classList.contains('open'));
          item?.classList.toggle('open', isOpen);
          if (head) head.textContent = isOpen ? "–" : "+";
          dot.dataset.open = isOpen ? "true" : "false";
          if (window.innerWidth < 768 && isOpen) {
            descBoxCorolla.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
          }
        } else {
          item?.classList.remove('open');
          if (head) head.textContent = "+";
          dot.dataset.open = "false";
        }
      });
    }

    // ---------------- INIT ----------------
    currentFeaturesCorolla = FEATURES_COROLLA_AVANT;
    renderCorolla(currentFeaturesCorolla, "image/corola_s/black/36.jpg", "Corolla Avant");

    document.getElementById('btn-avant').addEventListener('click', () => {
      currentFeaturesCorolla = FEATURES_COROLLA_AVANT;
      renderCorolla(currentFeaturesCorolla, "image/corola_s/black/36.jpg", "Corolla Avant");
      document.getElementById('btn-avant').classList.add("active");
      document.getElementById('btn-arriere').classList.remove("active");
    });

    document.getElementById('btn-arriere').addEventListener('click', () => {
      currentFeaturesCorolla = FEATURES_COROLLA_ARRIERE;
      renderCorolla(currentFeaturesCorolla, "image/corola_s/black/19.jpg", "Corolla Arrière");
      document.getElementById('btn-arriere').classList.add("active");
      document.getElementById('btn-avant').classList.remove("active");
    });

    // ---------------- EVENTS ----------------
    listCorolla.addEventListener('click', e => {
      const head = e.target.closest('.head');
      if (!head) return;
      toggleFeatureCorolla(head.dataset.target, currentFeaturesCorolla);
    });

    stageCorolla.addEventListener('click', e => {
      const dot = e.target.closest('.dot');
      if (!dot) return;
      toggleFeatureCorolla(dot.dataset.target, currentFeaturesCorolla);
    });

    // ---------------- EXPORT ----------------
    window.switchColor = switchColor;
    window.img = img;
  }
</script>

</body>
</html>
