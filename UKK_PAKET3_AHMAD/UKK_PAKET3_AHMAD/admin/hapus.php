<?php
require_once "../config/koneksi.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    // hapus dulu pengaduan
    mysqli_query($conn, "DELETE FROM pengaduan WHERE user_id=$id");

    // hapus user
    $hapus = mysqli_query($conn, "DELETE FROM user WHERE id=$id");

    if($hapus){
        header("Location: siswa.php");
        exit;
    } else {
        echo "Gagal hapus: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan";
}
?>