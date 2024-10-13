<?php
session_start();
session_unset();
 // Menghancurkan sesi
session_destroy();
header("Location: login.php"); // Mengarahkan kembali ke halaman login
exit();
?>