<?php
require_once "../config/koneksi.php";

class User {

    // FUNCTION LOGIN
    public function login($username, $password) {

        global $conn;

        $username = mysqli_real_escape_string($conn, $username);
        $password = md5($password);

        $query = "SELECT * FROM user 
                  WHERE username='$username' 
                  AND password='$password'";

        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }

    // FUNCTION REGISTER
public function register($nama, $username, $password) {

    global $conn;

    $nama = mysqli_real_escape_string($conn, $nama);
    $username = mysqli_real_escape_string($conn, $username);
    $password = md5($password);
    $role = 'siswa'; // otomatis siswa

    $query = "INSERT INTO user (nama, username, password, role)
              VALUES ('$nama', '$username', '$password', '$role')";

    return mysqli_query($conn, $query);
}

}
?>