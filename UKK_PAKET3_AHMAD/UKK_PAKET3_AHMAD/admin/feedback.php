<?php
session_start();
require_once "../config/koneksi.php";

$id = $_GET['id'];

if (isset($_POST['kirim_feedback'])) {

    $feedback = $_POST['feedback'];

    $query = "UPDATE pengaduan 
              SET feedback='$feedback' 
              WHERE id='$id'";

    mysqli_query($conn, $query);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }

        h3 {
            margin-bottom: 20px;
            color: #333;
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: none;
            font-size: 14px;
            transition: 0.3s;
        }

        textarea:focus {
            border-color: #74ebd5;
            outline: none;
            box-shadow: 0 0 5px rgba(116,235,213,0.8);
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: #74ebd5;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #5bc0be;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Berikan Feedback</h3>

    <form method="POST">
        <textarea name="feedback" placeholder="Tulis feedback Anda..." required></textarea><br><br>
        <button type="submit" name="kirim_feedback">Kirim</button>
    </form>
</div>

</body>
</html>