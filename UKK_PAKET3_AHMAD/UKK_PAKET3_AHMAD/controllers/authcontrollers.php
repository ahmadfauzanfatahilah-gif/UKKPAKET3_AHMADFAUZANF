<?php
session_start();
require_once "../models/User.php";

if (isset($_POST['login'])) {

    $userModel = new User();
    $user = $userModel->login($_POST['username'], $_POST['password']);

    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../siswa/dashboard.php");
        }
    } else {
        echo "<script>alert('Login gagal!');window.location='../views/login.php';</script>";
    }
}
if (isset($_POST['register'])) {

    $userModel = new User();
    $result = $userModel->register(
        $_POST['nama'],
        $_POST['username'],
        $_POST['password']
    );

    if ($result) {
        echo "<script>alert('Registrasi berhasil!');window.location='../views/login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal! Username mungkin sudah ada.');window.location='../views/register.php';</script>";
    }
}
if (isset($_POST['kirim_pengaduan'])) {

    require_once "../models/Pengaduan.php";
    $pengaduan = new Pengaduan();

    $result = $pengaduan->tambah(
        $_SESSION['id'],
        $_POST['judul'],
        $_POST['isi']
    );

    if ($result) {
        echo "<script>alert('Pengaduan berhasil dikirim!');window.location='../siswa/dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pengaduan!');window.history.back();</script>";
    }
}
?>
