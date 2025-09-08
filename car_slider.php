<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tours de l'oriental</title>
  <link rel="website icon" type="svg" href="img/icon.svg">
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <div class="container swiper">
      <a href="home.php" class="back-button">← Retour à l'accueil</a>

      <div class="wrapper">
        <div class="card-list swiper-wrapper">
          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/LandCruiser250a.jpg" alt="Land Cruiser" />
            </div>
            <div class="card-content">
              <h3 class="card-title">Land Cruiser Prado </h3>
              <div class="card-footer">
                <a href="product_detaille/index.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/Toyota-Yaris-Cross.jpg" alt="YarisCross" />
              <div class="card-tag">SUV</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Yaris Cross (Hybride)</h3>
              <div class="card-footer">
                <a href="product_detaille/index2.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/newyaris.png" alt="New Yaris" />
              <div class="card-tag">CITADINE</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">New Yaris (Dispo Hybride)</h3>
              <div class="card-footer">
                <a href="product_detaille/index3.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/corola_sport.jpg" alt="corolla sport" />
              <div class="card-tag">COMPACT</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Corolla Sport 140 (Hybride)</h3>
              <div class="card-footer">
                <a href="product_detaille/index4.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/corolla-prestige.jpg" alt="Corolla Pprestige" />
              <div class="card-tag">BERLINE</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Corolla Prestige (Hybride)</h3>
              <div class="card-footer">
                <a href="product_detaille/index5.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>


          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/corola_x.png" alt="Corola X" />
              <div class="card-tag">SUV</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Corola X Suv (Hybride)</h3>
              <div class="card-footer">
                <a href="product_detaille/index6.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>


                    <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/rav4.png" alt="rav4" />
              <div class="card-tag">SUV</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Rav 4 (Hybride)</h3>
              <div class="card-footer">
                <a href="product_detaille/index7.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/fortuner.png" alt="fortuner" />
              <div class="card-tag">SUV</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">fortuner</h3>
              <div class="card-footer">
                <a href="product_detaille/index8.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

                    <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/hilux_simple_cabine.png" alt="hilux simple cabine" />
              <div class="card-tag">PICK_UP</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Hilux Simple Cabine</h3>
              <div class="card-footer">
                <a href="product_detaille/index9.php" class="card-button">En savoir plus</a>
              </div>
            </div>
          </div>

          <!-- Single Card -->
          <div class="card swiper-slide">
            <div class="card-image">
              <img src="image/hilux_double_cabine.png" alt="hilux double cabine" />
              <div class="card-tag">PICK_UP</div>
            </div>
            <div class="card-content">
              <h3 class="card-title">Hilux Double Cabine</h3>
              <div class="card-footer">
                <a href="product_detaille/pdf/hilux_double_cabine.pdf" download class="card-button" >Télécharger le PDF</a>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-pagination"></div>

        <div class="swiper-slide-button swiper-button-prev"></div>
        <div class="swiper-slide-button swiper-button-next"></div>
      </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="app2.js"></script>
</body>
</html>
