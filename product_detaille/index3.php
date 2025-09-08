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
      $about   = "message new yaris";

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
<body class="page-new_yaris">

<nav>
  <ul class="sidebar">
    <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
    <li><a href="#presentation">Présentation</a></li>
    <li><a href="#caracteristiques">Caractéristiques</a></li>
  </ul>
  <ul>
    <li class="logo">Toyota New Yaris</li>
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
        <img src="image/new_yaris/black2/2.jpg" class="slide">
      </div>
      <div class="option flex">
        <img src="image/new_yaris/black2/4.jpg" onclick="img('image/new_yaris/black2/4.jpg')">
        <img src="image/new_yaris/black2/8.jpg" onclick="img('image/new_yaris/black2/8.jpg')">
        <img src="image/new_yaris/black2/16.jpg" onclick="img('image/new_yaris/black2/16.jpg')">
        <img src="image/new_yaris/black2/19.jpg" onclick="img('image/new_yaris/black2/19.jpg')">
        <img src="image/new_yaris/black2/24.jpg" onclick="img('image/new_yaris/black2/24.jpg')">
        <img src="image/new_yaris/black2/36.jpg" onclick="img('image/new_yaris/black2/36.jpg')">
      </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
      <h3>Toyota New Yaris </h3>
      <p class="paragraphe">
         La Toyota New Yaris se distingue par son design moderne et dynamique, 
          sa consommation réduite et ses technologies avancées. 
          Conçue pour la ville mais parfaitement adaptée aux longs trajets, 
          elle offre confort, sécurité et une expérience de conduite agréable au quotidien.
      </p>
<h5>Available Colors</h5>
<div class="color flex1">
  <span style="background:#333;" onclick="switchColor('black1')" title="Noir 1"></span> <!-- Noir 1 -->
  <span style="background:#000;" onclick="switchColor('black2')" title="Noir 2"></span> <!-- Noir 2 -->
  <span style="background:#9ca3af;" onclick="switchColor('gris')" title="Gris"></span> <!-- Gris -->
  <span style="background:#8b0000;" onclick="switchColor('grona')" title="Rouge foncé"></span> <!-- Rouge foncé -->
  <span style="background:#dc2626;" onclick="switchColor('red')" title="Rouge"></span> <!-- Rouge classique -->
  <span style="background:#fff; border:1px solid #ccc;" onclick="switchColor('white')" title="Blanc"></span> <!-- Blanc -->
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
    <img id="car-image" src="image/new_yaris/black1/2.jpg" alt="Voiture Avant">
  </section>
</div>

<div class="description-box" id="description">
  <h2>Sélectionnez une zone</h2>
  <p>Cliquez sur un point sur la voiture pour voir la description ici.</p>
</div>

<a href="pdf/new_yaris_pdf.pdf" download class="download-btn" title="Télécharger le PDF">
  <i class="fa-solid fa-file"></i>
</a>
<button class="contact-btn" id="contactBtn" title="Contact">
  <i class="fa-solid fa-envelope"></i>
</button>
<div class="contact-form-container" id="contactForm">
    <form action="index3.php" method="POST">
      <?php if(isset($formMessage)) { echo '<p class="form-message">'.$formMessage.'</p>'; } ?>
      <input type="text" name="name" placeholder="Nom" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Téléphone" required>
      <textarea name="message" rows="3" placeholder="Message" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
</div>

<script>
  let imagesNewYaris = {
      black1: ["image/new_yaris/black1/2.jpg","image/new_yaris/black1/4.jpg","image/new_yaris/black1/8.jpg","image/new_yaris/black1/16.jpg","image/new_yaris/black1/19.jpg","image/new_yaris/black1/24.jpg","image/new_yaris/black1/36.jpg"],
      black2: ["image/new_yaris/black2/2.jpg","image/new_yaris/black2/4.jpg","image/new_yaris/black2/8.jpg","image/new_yaris/black2/16.jpg","image/new_yaris/black2/19.jpg","image/new_yaris/black2/24.jpg","image/new_yaris/black2/36.jpg"],
      white: ["image/new_yaris/white/2.jpg","image/new_yaris/white/4.jpg","image/new_yaris/white/8.jpg","image/new_yaris/white/16.jpg","image/new_yaris/white/19.jpg","image/new_yaris/white/24.jpg","image/new_yaris/white/36.jpg"],
      gris: ["image/new_yaris/gris/2.jpg","image/new_yaris/gris/4.jpg","image/new_yaris/gris/8.jpg","image/new_yaris/gris/16.jpg","image/new_yaris/gris/19.jpg","image/new_yaris/gris/24.jpg","image/new_yaris/gris/36.jpg"],
      grona: ["image/new_yaris/grona/2.jpg","image/new_yaris/grona/4.jpg","image/new_yaris/grona/8.jpg","image/new_yaris/grona/16.jpg","image/new_yaris/grona/19.jpg","image/new_yaris/grona/24.jpg","image/new_yaris/grona/36.jpg"],
      red: ["image/new_yaris/red/2.jpg","image/new_yaris/red/4.jpg","image/new_yaris/red/8.jpg","image/new_yaris/red/16.jpg","image/new_yaris/red/19.jpg","image/new_yaris/red/24.jpg","image/new_yaris/red/36.jpg"]
  };

  // fonction pour changer l'image principale
  function img(src) {
      document.querySelector('.slide').src = src;
  }

  // fonction pour changer la couleur
  function switchColor(color) {
      const isNewYaris = document.body.classList.contains("page-new_yaris");
      if (!isNewYaris) {
          console.error("Cette page n'est pas une page New Yaris !");
          return;
      }

      let images = imagesNewYaris;

      if (!images[color]) {
          console.error("Couleur non trouvée ! :", color);
          return;
      }

      // vider les miniatures
      let optionDiv = document.querySelector('.option');
      optionDiv.innerHTML = "";

      // ajouter les miniatures de la couleur choisie
      images[color].forEach(src => {
          let imgTag = document.createElement("img");
          imgTag.src = src;
          imgTag.onclick = () => img(src);
          optionDiv.appendChild(imgTag);
      });

      // afficher la première image
      document.querySelector('.slide').src = images[color][0];
  }
  // ---------------- NAV ----------------
  function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'flex'
  }
  function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display = 'none'
  }




  // -------- Contact Form Toggle --------
  const contactBtn = document.getElementById("contactBtn");
  const contactForm = document.getElementById("contactForm");

  // Toggle ouverture/fermeture
  if (contactBtn && contactForm) {
    contactBtn.addEventListener("click", () => {
      if (contactForm.style.display === "flex") {
        contactForm.style.display = "none";
      } else {
        contactForm.style.display = "flex";
      }
    });
  }

  // Fermer si clic à l'extérieur du formulaire
  window.addEventListener("click", (e) => {
    if (
      contactForm.style.display === "flex" &&
      !contactForm.contains(e.target) &&
      e.target !== contactBtn
    ) {
      contactForm.style.display = "none";
    }
  });




  // ---------------- NEW YARIS FEATURES ----------------
// ---------------- CARACTERISTIQUES NEW YARIS ----------------
  const FEATURES_YARIS_AVANT = [
    { id: "grille", title: "Calandre Dynamique", text: "Calandre élargie avec design sportif et aérodynamique.", icon: "fa-solid fa-grip-lines", category: "Design", pos: { top: "60%", left: "43%" } },
    { id: "phares", title: "Phares LED", text: "Phares Full LED pour une meilleure visibilité de nuit et faible consommation.", icon: "fa-solid fa-lightbulb", category: "Sécurité", pos: { top: "48%", left: "62%" } },
    { id: "logo", title: "Logo Toyota", text: "Logo Toyota central intégré pour une finition premium.", icon: "fa-solid fa-gem", category: "Identité", pos: { top: "60%", left: "55%" } },
    { id: "parechocs", title: "Pare-chocs Avant", text: "Pare-chocs redessiné pour absorber les chocs et améliorer l’aérodynamisme.", icon: "fa-solid fa-shield-halved", category: "Sécurité", pos: { top: "67%", left: "49%" } },
    { id: "antibrouillard", title: "Feux Antibrouillard", text: "Feux antibrouillard puissants pour conditions difficiles.", icon: "fa-solid fa-cloud", category: "Sécurité", pos: { top: "63%", left: "63%" } }
  ];

  const FEATURES_YARIS_ARRIERE = [
    { id: "feux", title: "Feux Arrière LED", text: "Nouvelle signature lumineuse LED pour sécurité et style.", icon: "fa-solid fa-car-rear", category: "Sécurité", pos: { top: "41%", left: "48%" } },
    { id: "hayon", title: "Hayon Mains Libres", text: "Hayon arrière électrique pour un accès facile au coffre.", icon: "fa-solid fa-box-open", category: "Confort", pos: { top: "65%", left: "60%" } },
    { id: "lunette", title: "Lunette Arrière", text: "Lunette arrière élargie avec essuie-glace intégré.", icon: "fa-solid fa-eye", category: "Sécurité", pos: { top: " 35%", left: "55%" } },
    { id: "spoiler", title: "Spoiler Sportif", text: "Spoiler aérodynamique améliorant la stabilité et le style.", icon: "fa-solid fa-wind", category: "Design", pos: { top: "38%", left: "65%" } },
    { id: "parechocs_ar", title: "Pare-chocs Arrière", text: "Pare-chocs robuste et stylisé pour plus de sécurité en collision.", icon: "fa-solid fa-shield", category: "Sécurité", pos: { top: "60%", left: "55%" } }
  ];
  // ---------------- VARIABLES ----------------
  const list = document.getElementById('list');
  const stage = document.getElementById('stage');
  const carImage = document.getElementById('car-image');
  const descBox = document.getElementById('description');
  let currentFeatures = [];

  // ---------------- RENDER ----------------
  function render(features, imageSrc, altText) {
    list.querySelectorAll('.item').forEach(el => el.remove());
    stage.querySelectorAll('.dot').forEach(dot => dot.remove());
    carImage.src = imageSrc;
    carImage.alt = altText;

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
      list.appendChild(item);

      const dot = document.createElement('div');
      dot.className = 'dot';
      dot.style.top = f.pos.top;
      dot.style.left = f.pos.left;
      dot.dataset.target = f.id;
      dot.dataset.open = "false";
      stage.appendChild(dot);
    });

    descBox.innerHTML = `<h2>Sélectionnez une zone</h2><p>Cliquez sur un point sur la voiture pour voir la description ici.</p>`;
  }

  // ---------------- TOGGLE FEATURE ----------------
  function toggleFeature(id, features) {
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
          descBox.innerHTML = `<h2>${f.title}</h2><p>${f.text}</p>`;
        }
      } else {
        item?.classList.remove('open');
        if (head) head.textContent = "+";
        dot.dataset.open = "false";
      }
    });
  }

  // ---------------- INIT PAGE ----------------
  if (document.body.classList.contains("page-new_yaris")) {
    currentFeatures = FEATURES_YARIS_AVANT;
    render(currentFeatures, "image/new_yaris/black1/2.jpg", "Yaris Avant");

    document.getElementById('btn-avant').addEventListener('click', () => {
      currentFeatures = FEATURES_YARIS_AVANT;
      render(currentFeatures, "image/new_yaris/black1/2.jpg", "Yaris Avant");
      document.getElementById('btn-avant').classList.add("active");
      document.getElementById('btn-arriere').classList.remove("active");
    });

    document.getElementById('btn-arriere').addEventListener('click', () => {
      currentFeatures = FEATURES_YARIS_ARRIERE;
      render(currentFeatures, "image/new_yaris/black1/19.jpg", "Yaris Arrière");
      document.getElementById('btn-arriere').classList.add("active");
      document.getElementById('btn-avant').classList.remove("active");
    });
  }

  // ---------------- EVENTS ----------------
  list.addEventListener('click', e => {
    const head = e.target.closest('.head');
    if (!head) return;
    toggleFeature(head.dataset.target, currentFeatures);
  });

  stage.addEventListener('click', e => {
    const dot = e.target.closest('.dot');
    if (!dot) return;
    toggleFeature(dot.dataset.target, currentFeatures);
  });

</script>



</body>
</html>
