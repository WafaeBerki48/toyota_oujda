<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="img/icon.svg">
    <title>Tours de l'oriental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head> 

<?php
  session_start();

  $conn = new mysqli("localhost", "root", "", "tours_oriental");
  if ($conn->connect_error) {
      die('<div class="message error">Erreur de connexion à la base de données.</div>');
  }

  $message = '';
  $name = '';
  $comment = '';
  $stars = 0;
  $imagePath = 'img/image.jpg';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = trim($_POST['name'] ?? '');
      $comment = trim($_POST['comment'] ?? '');
      $stars = intval($_POST['stars'] ?? 0);

      // ---------- Connexion secrète admin ----------
      if (strtolower($name) === 'admin' && $comment === 'pass1234') {
          $_SESSION['admin'] = true;
          header("Location: admin/admin_panel.php");
          exit;
      }

      // Vérification des champs
      if ($name === '' || $stars < 1 || $stars > 5 || $comment === '') {
          $message = '<div class="message error">Tous les champs obligatoires doivent être remplis.</div>';
      } else {
          // Vérifier et enregistrer l'image si elle est présente
          if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
              $uploadDir = __DIR__ . '/uploads/';
              if (!is_dir($uploadDir)) {
                  mkdir($uploadDir, 0755, true);
              }

              $tmpName = $_FILES['image']['tmp_name'];
              $fileSize = $_FILES['image']['size'];
              $fileName = uniqid('img_') . '-' . basename($_FILES['image']['name']);
              $destPath = $uploadDir . $fileName;

              if ($fileSize > 2 * 1024 * 1024) {
                  $message = '<div class="message error">Le fichier est trop volumineux (max 2 Mo).</div>';
              } else {
                  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                  $mime = mime_content_type($tmpName);
                  if (!in_array($mime, $allowedTypes)) {
                      $message = '<div class="message error">Format de l\'image non autorisé.</div>';
                  } else {
                      if (move_uploaded_file($tmpName, $destPath)) {
                          $imagePath = 'uploads/' . $fileName;
                      } else {
                          $message = '<div class="message error">Erreur lors de l\'upload de l\'image.</div>';
                      }
                  }
              }
          }

          if ($message === '') {
              $stmt = $conn->prepare("INSERT INTO testimonials (name, image, stars, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
              $stmt->bind_param("ssis", $name, $imagePath, $stars, $comment);
              if ($stmt->execute()) {
                  $message = '<div class="message success">Merci pour votre témoignage !</div>';
                  $name = '';
                  $stars = 0;
                  $comment = '';
                  $imagePath = 'img/image.jpg';
              } else {
                  $message = '<div class="message error">Erreur lors de l\'ajout du témoignage.</div>';
              }
              $stmt->close();
          }
      }
  }

  $conn->close();
?>
<body>

<section class="add-testimonial">

  <button 
    type="button" 
    onclick="window.location.href='feautred.php'" 
    class="back-button"
    aria-label="Retour à la page featured"
  >
    ← Retour
  </button>

  <h2>Laissez un commentaire</h2>

  <div id="form-message">
    <?= $message ?>
  </div>

  <form action="" method="post" enctype="multipart/form-data" novalidate>
    <label for="name">Nom :</label>
    <input
      type="text"
      id="name"
      name="name"
      required
      value="<?= htmlspecialchars($name) ?>"
    />

    <label for="stars">Note :</label>
    <div class="star-rating" aria-label="Notation par étoiles">
      <input type="radio" name="stars" id="star5" value="5" <?= ($stars == 5) ? 'checked' : '' ?> required />
      <label for="star5"><i class="fas fa-star"></i></label>

      <input type="radio" name="stars" id="star4" value="4" <?= ($stars == 4) ? 'checked' : '' ?> />
      <label for="star4"><i class="fas fa-star"></i></label>

      <input type="radio" name="stars" id="star3" value="3" <?= ($stars == 3) ? 'checked' : '' ?> />
      <label for="star3"><i class="fas fa-star"></i></label>

      <input type="radio" name="stars" id="star2" value="2" <?= ($stars == 2) ? 'checked' : '' ?> />
      <label for="star2"><i class="fas fa-star"></i></label>

      <input type="radio" name="stars" id="star1" value="1" <?= ($stars == 1) ? 'checked' : '' ?> />
      <label for="star1"><i class="fas fa-star"></i></label>
    </div>

    <label for="image">Votre photo (optionnel) :</label>
    <input type="file" id="image" name="image" accept="image/*" />

    <label for="comment">Commentaire :</label>
    <textarea
      id="comment"
      name="comment"
      rows="5"
      required><?= htmlspecialchars($comment) ?></textarea>

    <button type="submit">Envoyer</button>
  </form>
</section>

</body>
</html>
