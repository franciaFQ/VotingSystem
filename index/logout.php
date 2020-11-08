/* Destroy current user session */

<?php
session_start();
session_unset($_SESSION['nombre']);
session_destroy();

header('location: index.php');
?>