<?php
    $conn = new mysqli("localhost", "root", "", "tours_oriental");

    if ($conn->connect_error) {
        die("Erreur connexion DB: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM settings WHERE id = 1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $address_oujda   = $row['address_oujda'];
        $phone1_oujda    = $row['phone1_oujda'];
        $phone2_oujda    = $row['phone2_oujda'];
        $address_berkane = $row['address_berkane'];
        $phone1_berkane  = $row['phone1_berkane'];
        $email_contact   = $row['email_contact'];
        $facebook        = $row['facebook'];
        $instagram       = $row['instagram'];
    } else {
        echo "Aucune donnée trouvée";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tours de l'oriental</title>
  <link rel="website icon" type="svg" href="img/icon.svg">
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<nav>
  <div class="container nav-container">
    <a href="#" class="logo">
      <img src="img/icon.svg" alt="Logo">
    </a>

    <div class="menu-toggle" id="menu-toggle">
      <i class="fa-solid fa-bars"></i>
    </div>
    <div class="menu-close" id="menu-close" style="display: none;">
      <i class="fa-solid fa-xmark"></i>
    </div>

    <ul class="nav-link" id="nav-link">
      <li><a href="home.php">Accueil</a></li>
      <li><a href="about.php">À propos</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="feautred.php" class="active" >testimonials</a></li>
      <li><a href="contact.php" >Contact</a></li>

      <li class="mobile-socials">
        <a href="<?= $facebook ?>"><i class="fab fa-facebook"></i></a>
        <a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a>
      </li>
    </ul>

    <ul class="social-link">
      <li><a href="<?= $facebook ?>"><i class="fab fa-facebook"></i></a></li>
      <li><a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a></li>
    </ul>
  </div>
</nav>

<?php
    $conn = new mysqli("localhost", "root", "", "tours_oriental");

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Nombre par page
    $limit = 6;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;

    // Compter total
    $total_sql = "SELECT COUNT(*) FROM testimonials";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_row();
    $total = $total_row[0];
    $total_pages = ceil($total / $limit);

    // Récupérer les témoignages
    $sql = "SELECT * FROM testimonials ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
?>

<section class="testimonials">
    <div class="testimonial-heading">
        <span>Commentaires</span>
        <button class="button"><a href="reviews_form.php">Ajouter votre commentaire</a></button>
    </div>

    <div class="testimonial-box-container">
        <?php
        if ($result->num_rows > 0) {
            while ($testimonial = $result->fetch_assoc()) {
                echo '<div class="testimonial-box">';
                echo '  <div class="box-top">';
                echo '    <div class="profile">';
                echo '      <div class="profile-img"><img src="' . htmlspecialchars($testimonial['image']) . '" alt=""></div>';
                echo '      <div class="name-user"><strong>' . htmlspecialchars($testimonial['name']) . '</strong></div>';
                echo '    </div>';
                echo '    <div class="reviews">';
                for ($i = 0; $i < 5; $i++) {
                    echo $i < $testimonial['stars'] ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                }
                echo '    </div>';
                echo '  </div>';
                echo '  <div class="client-comment"><p>' . htmlspecialchars($testimonial['comment']) . '</p></div>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucun témoignage disponible.</p>";
        }
        ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">&laquo;</a>
        <?php endif; ?>

        <!-- Toujours afficher 1 -->
        <?php if ($page > 3): ?>
            <a href="?page=1">1</a>
            <?php if ($page > 4): ?>
                <span>...</span>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Pages autour de la page actuelle -->
        <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
            <?php if ($i == $page): ?>
                <span class="active"><?= $i ?></span>
            <?php else: ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- Toujours afficher dernière page -->
        <?php if ($page < $total_pages - 2): ?>
            <?php if ($page < $total_pages - 3): ?>
                <span>...</span>
            <?php endif; ?>
            <a href="?page=<?= $total_pages ?>"><?= $total_pages ?></a>
        <?php endif; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>">&raquo;</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>

<?php $conn->close(); ?>

<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- Pages principales -->
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="home.php" >Accueil</a></li>
                    <li><a href="car_slider.php" >Modèles Toyota</a></li>
                    <li><a href="services.php" >Services</a></li>
                    <li><a href="contact.php" >Contact</a></li>
                    <li><a href="about.php" >À propos</a></li>
                    <li><a href="feautred.php" >Testimonials</a></li>
                </ul>
            </div>

            <!-- Modèles Toyota -->
            <div class="footer-col">
                <h4>Modèles Disponibles</h4>
                <ul>
                    <li><a href="product_detaille/index.php" >Land Cruiser Prado</a></li>
                    <li><a href="product_detaille/index2.php" >Yaris Cross (Hybride)</a></li>
                    <li><a href="product_detaille/index3.php" >New Yaris (Dispo Hybride)</a></li>
                    <li><a href="product_detaille/index4.php" >Corolla Sport 140 (Hybride)</a></li>
                    <li><a href="product_detaille/index5.php" >Corolla Prestige (Hybride)</a></li>
                    <li><a href="product_detaille/index6.php" >Corola X Suv (Hybride)</a></li>
                    <li><a href="product_detaille/index7.php">Rav 4 (Hybride)</a></li>
                    <li><a href="product_detaille/index8.php" >Fortuner</a></li>
                    <li><a href="product_detaille/index9.php" >Hilux Simple Cabine</a></li>
                    <li><a href="product_detaille/index10.php" >Hilux Double Cabine</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <ul style="color: black;">
                    <div class="aa">
                        <li><strong>Oujda :</strong> <?= $address_oujda ?></li>
                        <li>Tél1 : <?= $phone1_oujda ?></li>
                        <li>Tél2 : <?= $phone2_oujda ?></li>
                        <br>
                        <li><strong>Berkane :</strong> <?= $address_berkane ?></li>
                        <li>Tél : <?= $phone1_berkane ?></li>
                        <br>
                        <li>Email : <?= $email_contact ?></li>
                    </div>
                </ul>
            </div>

            <!-- Réseaux sociaux -->
            <div class="footer-col">
                <h4>Suivez-nous</h4>
                <div class="social-links">
                    <a href="<?= $facebook ?>"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="app.js"></script>

</body>
</html>