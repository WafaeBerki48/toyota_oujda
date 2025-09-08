<?php
session_start();
session_unset();
session_destroy();
header("Location: ../reviews_form.php");
exit;
