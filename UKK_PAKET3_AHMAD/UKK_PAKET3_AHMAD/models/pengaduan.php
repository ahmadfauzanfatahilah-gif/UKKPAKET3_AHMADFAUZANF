<?php
require_once "../config/koneksi.php";

class Pengaduan {

    public function tambah($user_id, $judul, $isi) {

        global $conn;

        $judul = mysqli_real_escape_string($conn, $judul);
        $isi = mysqli_real_escape_string($conn, $isi);

        $query = "INSERT INTO pengaduan (user_id, judul, isi)
                  VALUES ('$user_id', '$judul', '$isi')";

        return mysqli_query($conn, $query);
    }

public function getByUser($user_id) {

    global $conn;

    $query = "SELECT * FROM pengaduan 
              WHERE user_id='$user_id'
              ORDER BY tanggal DESC";

    return mysqli_query($conn, $query);
}
public function getAll() {

    global $conn;

    $query = "SELECT pengaduan.*, user.nama 
              FROM pengaduan
              JOIN user ON pengaduan.user_id = user.id
              ORDER BY tanggal DESC";

    return mysqli_query($conn, $query);
}
}
?>