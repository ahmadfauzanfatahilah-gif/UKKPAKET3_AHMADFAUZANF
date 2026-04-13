<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../views/login.php");
    exit;
}
?>