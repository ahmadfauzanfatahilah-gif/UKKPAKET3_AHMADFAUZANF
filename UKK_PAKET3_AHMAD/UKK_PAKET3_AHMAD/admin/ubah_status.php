<?php
session_start();
require_once "../config/koneksi.php";

$id = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE pengaduan 
          SET status='$status' 
          WHERE id='$id'";

mysqli_query($conn, $query);

header("Location: dashboard.php");
exit;
?>