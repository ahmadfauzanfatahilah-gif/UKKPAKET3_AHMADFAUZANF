<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width: 350px;">
    <h4 class="text-center mb-3">Login</h4>

    <form action="../controllers/authcontrollers.php" method="POST">
        <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button type="submit" name="login" class="btn btn-dark w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="register.php" class="text-dark">Belum punya akun?</a>
    </div>
</div>

</body>
</html>