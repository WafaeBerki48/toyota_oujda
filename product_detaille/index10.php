<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="website icon" type="svg" href="../img/icon.svg">
<title>404 - Page non trouvée</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background-color: #8B0000; /* rouge foncé */
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
    overflow: hidden;
  }
  .container {
    position: relative;
    z-index: 2;
  }
  .logo {
    width: 120px;
    margin-bottom: 0;
  }
  h1 {
    font-size: 10rem;
    margin-bottom: 10px;
    background: linear-gradient(45deg, #c6c1c1ff, #ae1919ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    font-weight: 400;
    color: #fff;
  }
  p {
    font-size: 1rem;
    margin-bottom: 30px;
    color: #f0f0f0;
  }
  .btn-home {
    background-color: #FF4C4C;
    color: #fff;
    padding: 12px 30px;
    font-size: 1.2rem;
    border-radius: 50px;
    text-decoration: none;
    transition: 0.3s;
  }
  .btn-home:hover {
    background-color: #E60012;
  }
  .car-bg {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    opacity: 0.1;
    z-index: 1;
  }
</style>
</head>
<body>
  <div class="container">
    <img src="../img/icon.svg" alt="Toyota Logo" class="logo">
    <h1>404</h1>
    <h2>Oups ! Cette page n’existe pas</h2>
    <p>Vous pouvez retourner à la page d’accueil pour continuer votre visite.</p>
    <a href="../home.php" class="btn-home"><i class="fa-solid fa-arrow-left"></i> Retour à l’accueil</a>
  </div>
  <img src="img/new_yaris/black1/2.jpg" alt="Toyota New Yaris" class="car-bg">
</body>
</html>
