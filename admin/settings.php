<?php
    // connexion bdd
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "tours_oriental";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    // récupérer les infos actuelles
    $sql = "SELECT * FROM settings LIMIT 1";
    $result = $conn->query($sql);
    $settings = $result->fetch_assoc();

    // message de retour
    $formMessage = "";

    // traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $address_oujda   = $conn->real_escape_string($_POST['address_oujda']);
        $phone1_oujda    = $conn->real_escape_string($_POST['phone1_oujda']);
        $phone2_oujda    = $conn->real_escape_string($_POST['phone2_oujda']);
        $address_berkane = $conn->real_escape_string($_POST['address_berkane']);
        $phone1_berkane  = $conn->real_escape_string($_POST['phone1_berkane']);
        $email_contact   = $conn->real_escape_string($_POST['email_contact']);
        $facebook        = $conn->real_escape_string($_POST['facebook']);
        $instagram       = $conn->real_escape_string($_POST['instagram']);

        if ($settings) {
            // UPDATE
            $sql = "UPDATE settings SET 
                address_oujda='$address_oujda',
                phone1_oujda='$phone1_oujda',
                phone2_oujda='$phone2_oujda',
                address_berkane='$address_berkane',
                phone1_berkane='$phone1_berkane',
                email_contact='$email_contact',
                facebook='$facebook',
                instagram='$instagram'
                WHERE id=" . $settings['id'];
        } else {
            // INSERT
            $sql = "INSERT INTO settings 
                (address_oujda, phone1_oujda, phone2_oujda, address_berkane, phone1_berkane, email_contact, facebook, instagram) 
                VALUES 
                ('$address_oujda','$phone1_oujda','$phone2_oujda','$address_berkane','$phone1_berkane','$email_contact','$facebook','$instagram')";
        }

        if ($conn->query($sql) === TRUE) {
            $formMessage = "Paramètres modifiés avec succès.";
            // mettre à jour $settings pour rafraîchir le formulaire
            $settings = [
                'address_oujda' => $address_oujda,
                'phone1_oujda' => $phone1_oujda,
                'phone2_oujda' => $phone2_oujda,
                'address_berkane' => $address_berkane,
                'phone1_berkane' => $phone1_berkane,
                'email_contact' => $email_contact,
                'facebook' => $facebook,
                'instagram' => $instagram
            ];
        } else {
            $formMessage = "Erreur : " . $conn->error;
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="website icon" type="svg" href="../img/icon.svg">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Tours de l'oriental - Settings</title>
</head> 
<body>

<section id="sidebar">
	<a href="#" class="brand">
		<img class="logo" src="../img/icon.svg" alt="Logo"><br>
		<span class="text">Tours de l'oriental</span>
	</a>
	<ul class="side-menu top">
		<li><a href="admin_panel.php"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a></li>
		<li><a href="testimonials.php"><i class='bx bxs-user-voice'></i><span class="text">Testimonials</span></a></li>
		<li><a href="messages.php"><i class='bx bxs-message-dots'></i><span class="text">Message</span></a></li>
	</ul>
	<ul class="side-menu">
		<li class="active"><a href="settings.php"><i class='bx bxs-cog'></i><span class="text">Settings</span></a></li>
		<li><a href="logout.php"><i class='bx bxs-log-out-circle'></i><span class="text">Logout</span></a></li>
	</ul>
</section>

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
    </nav>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Paramètres</h1>
                <ul class="breadcrumb">
                    <li><a href="admin_panel.php">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="settings.php">Settings</a></li>
                </ul>
            </div>
        </div>

        <h2>Modifier les paramètres</h2>
        <?php if($formMessage): ?>
            <p style="color:green;font-weight:bold"><?= $formMessage ?></p>
        <?php endif; ?>

        <form class="form" method="POST">
            <label>Adresse Oujda :</label>
            <input type="text" name="address_oujda" value="<?= $settings['address_oujda'] ?? '' ?>">

            <label>Téléphone 1 Oujda :</label>
            <input type="text" name="phone1_oujda" value="<?= $settings['phone1_oujda'] ?? '' ?>">

            <label>Téléphone 2 Oujda :</label>
            <input type="text" name="phone2_oujda" value="<?= $settings['phone2_oujda'] ?? '' ?>">

            <label>Adresse Berkane :</label>
            <input type="text" name="address_berkane" value="<?= $settings['address_berkane'] ?? '' ?>">

            <label>Téléphone Berkane :</label>
            <input type="text" name="phone1_berkane" value="<?= $settings['phone1_berkane'] ?? '' ?>">

            <label>Email :</label>
            <input type="email" name="email_contact" value="<?= $settings['email_contact'] ?? '' ?>">

            <label>Facebook :</label>
            <input type="text" name="facebook" value="<?= $settings['facebook'] ?? '' ?>">

            <label>Instagram :</label>
            <input type="text" name="instagram" value="<?= $settings['instagram'] ?? '' ?>">

            <button type="submit">Modifier</button>
        </form>
    </main>
</section>

<script src="app.js"></script>
</body>
</html>