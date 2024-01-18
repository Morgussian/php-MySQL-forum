<!-- ce fichier ne sera pas require mais simplement appelé -->
<?php
session_start();
$_SESSION = [];
session_destroy();
header('location: ../../login.php');
?>