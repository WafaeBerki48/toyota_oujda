// ---------------- PRADO FEATURES ----------------
const FEATURES_AVANT = [
  { id:"parebrise", title:"Pare-brise vertical", text:"Pare-brise vertical pour meilleure visibilité", pos:{top:"25%", left:"50%"} },
  { id:"protection", title:"Protection anti-encastrement", text:"Protection renforcée à l’avant", pos:{top:"62%", left:"30%"} },
  { id:"antibrouillard", title:"Feux anti-brouillard encastrés", text:"Intégrés dans le pare-chocs avant", pos:{top:"57%", left:"46%"} },
  { id:"led", title:"Feux full LED", text:"Signature lumineuse LED intégrale", pos:{top:"44%", left:"56%"} },
  { id:"logo", title:"Logo Héritage", text:"Logo emblématique de la marque", pos:{top:"45%", left:"40%"} },
  { id:"parechocs", title:"Pare-chocs avant", text:"Design robuste du pare-chocs", pos:{top:"52%", left:"25%"} },
  { id:"capot", title:"Capot", text:"Capot sculpté et aérodynamique", pos:{top:"34%", left:"30%"} }
];
const FEATURES_ARRIERE = [
  { id:"spoiler", title:"Spoiler arrière", text:"Avec spoiler + feu stop intégré", pos:{top:"20%", left:"80%"} },
  { id:"roues", title:"Passage de roues", text:"Large passage de roues", pos:{top:"50%", left:"35%"} },
  { id:"lunette", title:"Lunette arrière", text:"Lunette arrière élargie", pos:{top:"30%", left:"70%"} },
  { id:"coffre", title:"Coffre", text:"Hayon à ouverture électrique mains-libres", pos:{top:"50%", left:"70%"} },
  { id:"secours", title:"Roue de secours", text:"Roue de secours sous coffre", pos:{top:"65%", left:"80%"} },
  { id:"feux", title:"Feux arrières à LED", text:"Nouvelle signature lumineuse LED", pos:{top:"43%", left:"87%"} }
];

// ---------------- YARIS FEATURES ----------------
const FEATURES_YARIS_AVANT = [
  { id: "phare", title: "Projecteurs avant LED", text: "Éclairage Full LED avec signature lumineuse moderne.", pos: { top: "45%", left: "22%" } },
  { id: "grille", title: "Grille frontale", text: "Grille en nid d’abeille au style robuste et dynamique.", pos: { top: "52%", left: "40%" } },
  { id: "capot", title: "Lignes de capot", text: "Capot sculpté améliorant l’aérodynamisme et l’élégance.", pos: { top: "40%", left: "42%" } },
  { id: "anti-brouillard", title: "Feux antibrouillard", text: "Éclairage LED basse position pour plus de sécurité.", pos: { top: "57%", left: "53%" } },
  { id: "jantes", title: "Jantes en alliage", text: "Design 18’’ alliant sportivité et stabilité.", pos: { top: "72%", left: "58%" } }
];
const FEATURES_YARIS_ARRIERE = [
  { id: "feux", title: "Feux arrière LED", text: "Signature lumineuse horizontale avec effet 3D.", pos: { top: "32%", left: "58%" } },
  { id: "camera", title: "Caméra de recul", text: "Caméra HD intégrée avec lignes de guidage dynamiques.", pos: { top: "40%", left: "75%" } },
  { id: "coffre", title: "Volume de coffre", text: "390 L modulables, banquette rabattable 60/40.", pos: { top: "49%", left: "65%" } },
  { id: "toit", title: "Toit panoramique", text: "Grande ouverture vitrée offrant luminosité et confort.", pos: { top: "13%", left: "50%" } },
  { id: "parechoc", title: "Pare-chocs arrière", text: "Pare-chocs renforcé avec diffuseur sport.", pos: { top: "62%", left: "65%" } }
];


// ---------------- VARIABLES GENERALES ----------------
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
if (document.body.classList.contains("page-prado")) {
  currentFeatures = FEATURES_AVANT;
  render(currentFeatures, "image/voiture1.png", "Voiture Avant");

  document.getElementById('btn-avant').addEventListener('click', () => {
    currentFeatures = FEATURES_AVANT;
    render(currentFeatures, "image/voiture1.png", "Voiture Avant");
    document.getElementById('btn-avant').classList.add("active");
    document.getElementById('btn-arriere').classList.remove("active");
  });
  document.getElementById('btn-arriere').addEventListener('click', () => {
    currentFeatures = FEATURES_ARRIERE;
    render(currentFeatures, "image/voiture.png", "Voiture Arrière");
    document.getElementById('btn-arriere').classList.add("active");
    document.getElementById('btn-avant').classList.remove("active");
  });
}

if (document.body.classList.contains("page-yaris")) {
  currentFeatures = FEATURES_YARIS_AVANT;
  render(currentFeatures, "image/voiture_yaris.jpg", "Yaris Avant");

  document.getElementById('btn-avant').addEventListener('click', () => {
    currentFeatures = FEATURES_YARIS_AVANT;
    render(currentFeatures, "image/voiture_yaris.jpg", "Yaris Avant");
    document.getElementById('btn-avant').classList.add("active");
    document.getElementById('btn-arriere').classList.remove("active");
  });
  document.getElementById('btn-arriere').addEventListener('click', () => {
    currentFeatures = FEATURES_YARIS_ARRIERE;
    render(currentFeatures, "image/voiture_yaris2.jpg", "Yaris Arrière");
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

// ---------------- STOCK IMAGES ----------------
let imagesPrado = {
  white: ["image/prado/prado_white/2.jpg","image/prado/prado_white/4.jpg","image/prado/prado_white/8.jpg","image/prado/prado_white/16.jpg","image/prado/prado_white/19.jpg","image/prado/prado_white/24.jpg","image/prado/prado_white/36.jpg"],
  black: ["image/prado/prado_black/2.jpg","image/prado/prado_black/4.jpg","image/prado/prado_black/8.jpg","image/prado/prado_black/16.jpg","image/prado/prado_black/19.jpg","image/prado/prado_black/24.jpg","image/prado/prado_black/36.jpg"],
  blue: ["image/prado/prado_bleu/2.jpg","image/prado/prado_bleu/4.jpg","image/prado/prado_bleu/8.jpg","image/prado/prado_bleu/16.jpg","image/prado/prado_bleu/19.jpg","image/prado/prado_bleu/24.jpg","image/prado/prado_bleu/36.jpg"],
  gris_clair: ["image/prado/prado_gris_claire/2.jpg","image/prado/prado_gris_claire/4.jpg","image/prado/prado_gris_claire/8.jpg","image/prado/prado_gris_claire/16.jpg","image/prado/prado_gris_claire/19.jpg","image/prado/prado_gris_claire/24.jpg","image/prado/prado_gris_claire/36.jpg"],
  gris_fonce: ["image/prado/prado_gris_foncé/2.jpg","image/prado/prado_gris_foncé/4.jpg","image/prado/prado_gris_foncé/8.jpg","image/prado/prado_gris_foncé/16.jpg","image/prado/prado_gris_foncé/19.jpg","image/prado/prado_gris_foncé/24.jpg","image/prado/prado_gris_foncé/36.jpg"],
  moutarde: ["image/prado/prado_moutarde/2.jpg","image/prado/prado_moutarde/4.jpg","image/prado/prado_moutarde/8.jpg","image/prado/prado_moutarde/16.jpg","image/prado/prado_moutarde/19.jpg","image/prado/prado_moutarde/24.jpg","image/prado/prado_moutarde/36.jpg"]
};
let imagesYaris = {
  white: ["image/yaris_cross/white/2.jpg","image/yaris_cross/white/4.jpg","image/yaris_cross/white/8.jpg","image/yaris_cross/white/16.jpg","image/yaris_cross/white/19.jpg","image/yaris_cross/white/24.jpg","image/yaris_cross/white/36.jpg"],
  black: ["image/yaris_cross/black/2.jpg","image/yaris_cross/black/4.jpg","image/yaris_cross/black/8.jpg","image/yaris_cross/black/16.jpg","image/yaris_cross/black/19.jpg","image/yaris_cross/black/24.jpg","image/yaris_cross/black/36.jpg"],
  bleu: ["image/yaris_cross/bleu/2.jpg","image/yaris_cross/bleu/4.jpg","image/yaris_cross/bleu/8.jpg","image/yaris_cross/bleu/16.jpg","image/yaris_cross/bleu/19.jpg","image/yaris_cross/bleu/24.jpg","image/yaris_cross/bleu/36.jpg"],
  jeune: ["image/yaris_cross/jeune/2.jpg","image/yaris_cross/jeune/4.jpg","image/yaris_cross/jeune/8.jpg","image/yaris_cross/jeune/16.jpg","image/yaris_cross/jeune/19.jpg","image/yaris_cross/jeune/24.jpg","image/yaris_cross/jeune/36.jpg"],
  maron: ["image/yaris_cross/maron/2.jpg","image/yaris_cross/maron/4.jpg","image/yaris_cross/maron/8.jpg","image/yaris_cross/maron/16.jpg","image/yaris_cross/maron/19.jpg","image/yaris_cross/maron/24.jpg","image/yaris_cross/maron/36.jpg"],
  rouge: ["image/yaris_cross/rouge/2.jpg","image/yaris_cross/rouge/4.jpg","image/yaris_cross/rouge/8.jpg","image/yaris_cross/rouge/16.jpg","image/yaris_cross/rouge/19.jpg","image/yaris_cross/rouge/24.jpg","image/yaris_cross/rouge/36.jpg"]
};
let imagesNewYaris = {
  white: [
    "image/new_yaris/white/2.jpg",
    "image/new_yaris/white/4.jpg",
    "image/new_yaris/white/8.jpg",
    "image/new_yaris/white/16.jpg",
    "image/new_yaris/white/19.jpg",
    "image/new_yaris/white/24.jpg",
    "image/new_yaris/white/36.jpg"
  ],
  black1: [
    "image/new_yaris/black1/2.jpg",
    "image/new_yaris/black1/4.jpg",
    "image/new_yaris/black1/8.jpg",
    "image/new_yaris/black1/16.jpg",
    "image/new_yaris/black1/19.jpg",
    "image/new_yaris/black1/24.jpg",
    "image/new_yaris/black1/36.jpg"
  ],
  black2: [
    "image/new_yaris/black2/2.jpg",
    "image/new_yaris/black2/4.jpg",
    "image/new_yaris/black2/8.jpg",
    "image/new_yaris/black2/16.jpg",
    "image/new_yaris/black2/19.jpg",
    "image/new_yaris/black2/24.jpg",
    "image/new_yaris/black2/36.jpg"
  ],
  bronze: [
    "image/new_yaris/bronze/2.jpg",
    "image/new_yaris/bronze/4.jpg",
    "image/new_yaris/bronze/8.jpg",
    "image/new_yaris/bronze/16.jpg",
    "image/new_yaris/bronze/19.jpg",
    "image/new_yaris/bronze/24.jpg",
    "image/new_yaris/bronze/36.jpg"
  ],
  gris: [
    "image/new_yaris/gris/2.jpg",
    "image/new_yaris/gris/4.jpg",
    "image/new_yaris/gris/8.jpg",
    "image/new_yaris/gris/16.jpg",
    "image/new_yaris/gris/19.jpg",
    "image/new_yaris/gris/24.jpg",
    "image/new_yaris/gris/36.jpg"
  ],
  grona: [
    "image/new_yaris/grona/2.jpg",
    "image/new_yaris/grona/4.jpg",
    "image/new_yaris/grona/8.jpg",
    "image/new_yaris/grona/16.jpg",
    "image/new_yaris/grona/19.jpg",
    "image/new_yaris/grona/24.jpg",
    "image/new_yaris/grona/36.jpg"
  ],
  red: [
    "image/new_yaris/red/2.jpg",
    "image/new_yaris/red/4.jpg",
    "image/new_yaris/red/8.jpg",
    "image/new_yaris/red/16.jpg",
    "image/new_yaris/red/19.jpg",
    "image/new_yaris/red/24.jpg",
    "image/new_yaris/red/36.jpg"
  ]
};


// ---------------- CHANGER IMAGE / COULEUR ----------------
function img(anything) {
  document.querySelector('.slide').src = anything;
}
function switchColor(color) {
  console.log("Switch color called:", color);

  let isPrado = document.body.classList.contains("page-prado");
  let isYaris = document.body.classList.contains("page-yaris");

  console.log("isPrado:", isPrado, "isYaris:", isYaris, );

  let images;
  if (isPrado) images = imagesPrado;
  else if (isYaris) images = imagesYaris;
  else {
    console.error("Aucun véhicule trouvé pour changer la couleur !");
    return;
  }

  if (!images[color]) {
    console.error("Couleur non trouvée ! :", color);
    return;
  }

  let optionDiv = document.querySelector('.option');
  optionDiv.innerHTML = "";

  images[color].forEach(src => {
    console.log("Ajout miniature:", src);
    let imgTag = document.createElement("img");
    imgTag.src = src;
    imgTag.onclick = () => img(src);
    optionDiv.appendChild(imgTag);
  });

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




