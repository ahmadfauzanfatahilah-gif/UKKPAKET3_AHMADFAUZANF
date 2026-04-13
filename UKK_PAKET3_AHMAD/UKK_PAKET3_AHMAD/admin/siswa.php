<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM user WHERE role='siswa'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f1f3f5;">

<div class="container mt-4">

    <h3 class="mb-3">👨‍🎓 Data Siswa</h3>

    <a href="dashboard.php" class="btn btn-dark mb-3">← Kembali</a>

    <div class="card p-3 shadow">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
    <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['username']; ?></td>
        <td>
            <a href="hapus.php?id=<?= $row['id']; ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin hapus user ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>  <!-- WAJIB ADA INI -->
</tbody>

            </table>
        </div>
    </div>

</div>

</body>
</html>