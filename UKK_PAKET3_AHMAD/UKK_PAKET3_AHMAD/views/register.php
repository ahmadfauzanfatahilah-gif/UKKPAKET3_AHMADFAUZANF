<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .btn-dark {
            background-color: black;
            border: none;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width: 400px;">
    <h4 class="text-center mb-3">Register</h4>

    <form action="../controllers/authcontrollers.php" method="POST">
        <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
        
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button type="submit" name="register" class="btn btn-dark w-100">
            Daftar
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="login.php" class="text-dark">Sudah punya akun?</a>
    </div>
</div>

</body>
</html>