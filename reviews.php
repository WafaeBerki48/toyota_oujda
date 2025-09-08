<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tours de l'oriental</title>
    <link rel="website icon" type="svg" href="img/icon.svg">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <section class="testimonials">
        <div class="testimonial-heading">
            <span>comments</span>
            <h1>Clients Says</h1>
        </div>
        <div class="testimonial-box-container">
            <?php
                $conn = new mysqli("localhost", "root", "", "tours_oriental");

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                $sql = "SELECT * FROM testimonials ORDER BY created_at DESC";
                $result = $conn->query($sql);

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
                            if ($i < $testimonial['stars']) {
                                echo '<i class="fas fa-star"></i>';
                            } else {
                                echo '<i class="far fa-star"></i>';
                            }
                        }
                        echo '    </div>';
                        echo '  </div>';
                        echo '  <div class="client-comment"><p>' . htmlspecialchars($testimonial['comment']) . '</p></div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Aucun témoignage disponible.</p>";
                }

                $conn->close();
            ?>
        </div>
    </section>
</body>
</html>
