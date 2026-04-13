<?php
require_once "../config/auth.php";

if ($_SESSION['role'] !== 'siswa') {
    header("Location: ../views/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body {
    background-color: #f1f3f5;
    font-family: 'Segoe UI', sans-serif;
}

.navbar {
    background-color: #212529;
}

.navbar-brand {
    color: white !important;
    font-weight: 600;
}

.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.table thead {
    background-color: #e9ecef;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transition: 0.2s;
}

.btn-dark {
    background-color: #212529;
    border: none;
}

.btn-dark:hover {
    background-color: black;
}

.badge {
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 20px;
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    100% { transform: rotate(360deg); }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar px-4">
    <span class="navbar-brand">
        <i class="fa-solid fa-gauge"></i> Dashboard Siswa
    </span>
    <a href="../logout.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</nav>

<div class="container mt-4">

    <!-- WELCOME CARD -->
    <div class="card p-4 mb-4">
        <h4>
            <i class="fa-solid fa-user"></i>
            Selamat datang, <?= $_SESSION['nama']; ?> 👋
        </h4>
    </div>

    <!-- FORM PENGADUAN -->
    <div class="card p-4 mb-4">
        <h5 class="mb-3">
            <i class="fa-solid fa-paper-plane"></i> Kirim Pengaduan
        </h5>

        <form action="../controllers/authcontrollers.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Pengaduan</label>
                <textarea name="isi" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" name="kirim_pengaduan" class="btn btn-dark">
                <i class="fa-solid fa-paper-plane"></i> Kirim
            </button>
        </form>
    </div>

    <!-- HISTORI -->
    <div class="card p-4">
        <h5 class="mb-3">
            <i class="fa-solid fa-clock-rotate-left"></i> Histori Pengaduan
        </h5>

        <?php
        require_once "../models/Pengaduan.php";
        $pengaduan = new Pengaduan();
        $data = $pengaduan->getByUser($_SESSION['id']);
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $row['judul']; ?></td>
                            <td><?= $row['isi']; ?></td>
                            <td>
                                <?php
                                $status = $row['status'];

                                if ($status == "Pending") {
                                    echo '<span class="badge bg-secondary">
                                            <i class="fa-solid fa-clock"></i> Pending
                                          </span>';
                                } elseif ($status == "Diproses") {
                                    echo '<span class="badge bg-warning text-dark">
                                            <i class="fa-solid fa-spinner"></i> Diproses
                                          </span>';
                                } elseif ($status == "Selesai") {
                                    echo '<span class="badge bg-success">
                                            <i class="fa-solid fa-circle-check"></i> Selesai
                                          </span>';
                                } else {
                                    echo '<span class="badge bg-dark">'.$status.'</span>';
                                }
                                ?>
                            </td>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['feedback']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>