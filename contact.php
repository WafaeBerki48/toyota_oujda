<?php
  $conn = new mysqli("localhost", "root", "", "tours_oriental");
  if ($conn->connect_error) {
      die("Erreur de connexion : " . $conn->connect_error);
  }

  $confirmation = ""; // variable pour stocker le message

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = htmlspecialchars($_POST["name"]);
      $email = htmlspecialchars($_POST["email"]);
      $phone = htmlspecialchars($_POST["phone"]);
      $message = htmlspecialchars($_POST["message"]);

      $sql = "INSERT INTO contact_us (name, email, phone, message) 
              VALUES ('$name', '$email', '$phone', '$message')";
      if ($conn->query($sql) === TRUE) {
          $confirmation = "✅ Votre message a été envoyé avec succès.";
      } else {
          $confirmation = "❌ Erreur lors de l’envoi : " . $conn->error;
      }
  }

  // Requête لجلب البيانات
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
  }
  $conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="img/icon.svg">
    <title>Tours de l'oriental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body,
  input,
  textarea {
    font-family: "Poppins", sans-serif;
  }

  .container1 {
    position: relative;
    width: 100%;
    min-height: 100vh;
    top: 35px;
    padding: 2rem;
    background-color: #fafafa;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .form {
    width: 100%;
    max-width: 820px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    overflow: hidden;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
  }

  .contact-form {
    background-color: #ad1f1f;
    position: relative;
  }

  .circle {
    border-radius: 50%;
    background: linear-gradient(135deg, transparent 20%, #ad1f1f);
    position: absolute;
  }

  .circle.one {
    width: 130px;
    height: 130px;
    top: 130px;
    right: -40px;
  }

  .circle.two {
    width: 80px;
    height: 80px;
    top: 10px;
    right: 30px;
  }

  .contact-form:before {
    content: "";
    position: absolute;
    width: 26px;
    height: 26px;
    background-color: #ad1f1f;
    transform: rotate(45deg);
    top: 50px;
    left: -13px;
  }

  form {
    padding: 2.3rem 2.2rem;
    z-index: 10;
    overflow: hidden;
    position: relative;
  }

  .title {
    color: #fff;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
    margin-bottom: 0.7rem;
  }

  .input-container {
    position: relative;
    margin: 1rem 0;   
  }

  .input {
    width: 100%;
    outline: none;
    border: 2px solid #fafafa;
    background: none;
    padding: 0.6rem 1.2rem;
    color: #fff;
    font-weight: 500;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    border-radius: 25px;
    transition: 0.3s;
  }

  textarea.input {
    padding: 0.8rem 1.2rem;
    min-height: 150px;
    border-radius: 22px;
    resize: none;
    overflow-y: auto;  
  }

  .input-container label {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    padding: 0 0.4rem;
    color: #fafafa;
    font-size: 0.9rem;
    font-weight: 400;
    pointer-events: none;
    z-index: 1000;
    transition: 0.5s;
  }

  .input-container.textarea label {
    top: 1rem;
    transform: translateY(0);
  }

  .btn {
    padding: 0.6rem 1.3rem;
    background-color: #fff;
    border: 2px solid #fafafa;
    font-size: 0.95rem;
    color: #ad1f1f;
    line-height: 1;
    border-radius: 25px;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
    margin: 0;
  }

  .btn:hover {
    background-color: transparent;
    color: #fff;
  }

  .input-container span {
    position: absolute;
    top: 0;
    left: 25px;
    transform: translateY(-50%);
    font-size: 0.8rem;
    padding: 0 0.4rem;
    color: transparent;
    pointer-events: none;
    z-index: 500;
  }

  .input-container span:before,
  .input-container span:after {
    content: "";
    position: absolute;
    width: 10%;
    opacity: 0;
    transition: 0.3s;
    height: 5px;
    background-color: #ad1f1f;
    top: 50%;
    transform: translateY(-50%);
  }

  .input-container span:before {
    left: 50%;
  }

  .input-container span:after {
    right: 50%;
  }

  .input-container.focus label {
    top: 0;
    transform: translateY(-50%);
    left: 25px;
    font-size: 0.8rem;
  }

  .input-container.focus span:before,
  .input-container.focus span:after {
    width: 50%;
    opacity: 1;
  }

  .contact-info {
    padding: 2.3rem 2.2rem;
    position: relative;
    animation: H1Ani forwards 1s ease;  
    opacity: 0;    
    animation-delay: 1s;  
  }

  .contact-info .title {
    color: #ad1f1f;
  }

  .text {
    color: #333;
    margin: 1.5rem 0 2rem 0;
  }

  .information {
    display: flex;
    color: #555;
    margin: 0.7rem 0;
    align-items: center;
    font-size: 0.95rem;
  }

  #icon {
    width: 40px;
    margin-right: 0.7rem;
    animation: H1Ani forwards 1s ease;  
    opacity: 0;    
    animation-delay: 1s;  
    color: #938c8cff;
  }

  .social-media {
    padding: 2rem 0 0 0;
  }

  .social-media p {
    color: #333;
  }

  .social-icons {
    display: flex;
    margin-top: 0.5rem;
    animation: H1Ani forwards 1s ease;  
    opacity: 0;    
    animation-delay: 1s;  
  }

  .social-icons a {
    width: 35px;
    height: 35px;
    border-radius: 5px;
    background: linear-gradient(45deg, #ad1f1f, #8b1313ff);
    color: #fff;
    text-align: center;
    line-height: 35px;
    margin-right: 0.5rem;
    transition: 0.3s;
  }

  .social-icons a:hover {
    transform: scale(1.05);
  }

  .contact-info:before {
    content: "";
    position: absolute;
    width: 110px;
    height: 100px;
    border: 22px solid #ad1f1f;
    border-radius: 50%;
    bottom: -77px;
    right: 50px;
    opacity: 0.3;
  }

  .big-circle {
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: linear-gradient(to bottom, #ad1f1f, #ad2525ff);
    bottom: 50%;
    right: 50%;
    transform: translate(-40%, 38%);
  }

  .big-circle:after {
    content: "";
    position: absolute;
    width: 360px;
    height: 360px;
    background-color: #fafafa;
    border-radius: 50%;
    top: calc(50% - 180px);
    left: calc(50% - 180px);
  }

  .square {
    position: absolute;
    height: 400px;
    top: 50%;
    left: 50%;
    transform: translate(181%, 11%);
    opacity: 0.2;
  }

  @media (max-width: 850px) {
    .form {
      grid-template-columns: 1fr;
    }

    .contact-info:before {
      bottom: initial;
      top: -75px;
      right: 65px;
      transform: scale(0.95);
    }

    .contact-form:before {
      top: -13px;
      left: initial;
      right: 70px;
    }

    .square {
      transform: translate(140%, 43%);
      height: 350px;
    }

    .big-circle {
      bottom: 75%;
      transform: scale(0.9) translate(-40%, 30%);
      right: 50%;
    }

    .text {
      margin: 1rem 0 1.5rem 0;
    }

    .social-media {
      padding: 1.5rem 0 0 0;
    }
  }

  @media (max-width: 480px) {
    .container {
      padding: 1.5rem;
    }

    .contact-info:before {
      display: none;
    }

    .square,
    .big-circle {
      display: none;
    }

    form,
    .contact-info {
      padding: 1.7rem 1.6rem;
    }

    .text,
    .information,
    .social-media p {
      font-size: 0.8rem;
    }

    .title {
      font-size: 1.15rem;
    }

    .social-icons a {
      width: 30px;
      height: 30px;
      line-height: 30px;
    }

    #icon {
      width: 23px;
    }

    .input {
      padding: 0.45rem 1.2rem;
    }

    .btn {
      padding: 0.45rem 1.2rem;
    }
  }
  @keyframes logoAni {
    0%{
        transform: translateX(-100px);
        opacity: 0;
    }    
    100%{
        transform: translateX(0);
        opacity: 1;
    }    
  }
  @keyframes NavliaAni {
      0%{
          transform: translateY(100px);
          opacity: 0;
      }    
      100%{
          transform: translateY(0);
          opacity: 1;
      }    
  }
  @keyframes socialAni {
      0%{
          transform: translateX(100px) rotate(45deg);
          opacity: 0;
      }    
      100%{
          transform: translateX(0) rotate(45deg);
          opacity: 1;
      }    
  }
  @keyframes H1Ani {
      0%{
          transform: translateY(-100px) ;
          opacity: 0;
      }    
      100%{
          transform: translateY(0) ;
          opacity: 1;
      }    
  }
  @keyframes zoomOut {
      0%{
          transform:scale(1.1) ;
          opacity: 0;
      }    
      100%{
          transform: scale(1) ;
          opacity: 1;
      }    
  }
  @keyframes carAni {
      0%{
          transform: translate(180px, -300px) scale(0) rotate(-45deg);
          opacity: 0;
      }    
      100%{
          transform: translate(0, 0) scale(1) rotate(-45deg);
          opacity: 1;
      }    
  }
  @keyframes sqbox2Ani {
      0%{
          right: -40%;
          opacity: 0;
      }    
      100%{
          right: -26%;
          opacity: 1;
      }    
  }
  .confirmation-message {
    margin-top: 15px;
    padding: 10px 15px;
    border-radius: 8px;
    font-weight: 500;
    text-align: center;
    animation: fadeIn 0.5s ease;
    color: #ffffffff;
  }

  .confirmation-message:contains("✅") {
    background-color: #d4edda;
    color: #ffffffff;
    border: 1px solid #c3e6cb;
  }

  .confirmation-message:contains("❌") {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

</style>
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
      <li><a href="feautred.php" >testimonials</a></li>
      <li><a href="contact.php" class="active">Contact</a></li>

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

<div class="container1">
  <span class="big-circle"></span>
  <img src="img/shape.png" class="square" alt="" />
  <div class="form">
    <div class="contact-info">
      <h3 class="title">Nous sommes à votre écoute</h3>
      <p class="text">
        Notre équipe est à votre disposition pour répondre à toutes vos questions,
        vous orienter dans vos démarches.
      </p>

      <div class="info">
        <p>Agence oujda</p>
        <div class="information">
          <i class="fas fa-map-marker-alt" id="icon" alt="" ></i>
          <p></strong> <?= $address_oujda ?> </p>
        </div>
        <div class="information">
          <i class="fas fa-phone-alt" id="icon" alt="" ></i>
          <p><?= $phone1_oujda ?> / <?= $phone2_oujda ?></p></br>
        </div>
      </div>
      <div class="info">
        <p >Agence Berkane</p>
        <div class="information">
          <i class="fas fa-map-marker-alt" id="icon" alt="" ></i>
          <p><?= $address_berkane ?> </p>
        </div>
        <div class="information">
          <i class="fas fa-phone-alt" id="icon" alt="" ></i>
          <p><?= $phone1_berkane ?></p>
        </div><br>
        <div class="information">
          <i class="fas fa-envelope" id="icon" alt="" ></i>
          <p><?= $email_contact ?></p>
        </div>

      </div>

      <div class="social-media">
        <p>Connect with us :</p>
        <div class="social-icons">
          <a href="<?= $facebook ?>"><i class="fab fa-facebook-f"></i></a>
          <a href="<?= $instagram ?>"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <div class="contact-form">
      <span class="circle one"></span>
      <span class="circle two"></span>

      <form action="contact.php" method="POST" autocomplete="off">
        <?php if (!empty($confirmation)) : ?>
          <p class="confirmation-message"><?= $confirmation ?></p>
        <?php endif; ?>
        <h3 class="title">Contact us</h3>
        <div class="input-container">
          <input type="text" name="name" class="input" required/>
          <label for="">Username</label>
          <span>Username</span>
        </div>
        <div class="input-container">
          <input type="email" name="email" class="input" required/>
          <label for="">Email</label>
          <span>Email</span>
        </div>
        <div class="input-container">
          <input type="tel" name="phone" class="input" required/>
          <label for="">Phone</label>
          <span>Phone</span>
        </div>
        <div class="input-container textarea">
          <textarea name="message" class="input" required></textarea>
          <label for="">Message</label>
          <span>Message</span>
        </div>
        <input type="submit" value="Send" class="btn" />
      </form>
    </div>
  </div>
</div>

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
