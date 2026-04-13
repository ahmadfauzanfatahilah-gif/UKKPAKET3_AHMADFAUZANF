<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}
// Total siswa
$totalSiswa = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM user WHERE role='siswa'")
);

// Total admin
$totalAdmin = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM user WHERE role='admin'")
);

// Total pengaduan
$totalPengaduan = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM pengaduan")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
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

.badge {
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 20px;
}

.btn-sm {
    border-radius: 20px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar px-4">
    <span class="navbar-brand">
        <i class="fa-solid fa-user-shield"></i> Dashboard Admin
    </span>
    <a href="../logout.php" class="btn btn-light btn-sm">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</nav>

<div class="container mt-4">
  <div class="row g-4">

 <div class="col-md-4">
  <a href="siswa.php" style="text-decoration: none; color: inherit;">
    <div class="card shadow border-0 hover-card">
      <div class="card-body">
        <h6 class="text-muted">Total Siswa</h6>
        <h3 class="fw-bold"><?= $totalSiswa; ?></h3>
      </div>
    </div>
  </a>
</div>

    <div class="col-md-4">
  <a href="admin.php" style="text-decoration: none; color: inherit;">
    <div class="card shadow border-0 hover-card">
      <div class="card-body">
        <h6 class="text-muted">Total Admin</h6>
        <h3 class="fw-bold"><?= $totalAdmin; ?></h3>
      </div>
    </div>
  </a>
</div>

    <div class="col-md-4">
      <div class="card shadow border-0">
        <div class="card-body">
          <h6 class="text-muted">Total Pengaduan</h6>
          <h3 class="fw-bold"><?= $totalPengaduan; ?></h3>
        </div>
      </div>
    </div>

  </div>
</div>

    <!-- WELCOME CARD -->
    <div class="card p-4 mb-4">
        <h4>
            <i class="fa-solid fa-user"></i>
            Selamat datang, <?= $_SESSION['nama']; ?> 👋
        </h4>
    </div>

    <!-- DATA PENGADUAN -->
    <div class="card p-4">
        <h5 class="mb-3">
            <i class="fa-solid fa-database"></i> Data Pengaduan Siswa
        </h5>

        <?php
        require_once "../models/Pengaduan.php";
        $pengaduan = new Pengaduan();
        $data = $pengaduan->getAll();
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['judul']; ?></td>
                            <td><?= $row['isi']; ?></td>

                            <!-- STATUS BERWARNA -->
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

                            <!-- AKSI BUTTON MODERN -->
                            <td>
                                <a href="ubah_status.php?id=<?= $row['id']; ?>&status=Diproses" 
                                   class="btn btn-warning btn-sm">
                                   <i class="fa-solid fa-spinner"></i>
                                </a>

                                <a href="ubah_status.php?id=<?= $row['id']; ?>&status=Selesai" 
                                   class="btn btn-success btn-sm">
                                   <i class="fa-solid fa-check"></i>
                                </a>

                                <a href="feedback.php?id=<?= $row['id']; ?>" 
                                   class="btn btn-dark btn-sm">
                                   <i class="fa-solid fa-comment"></i>
                                </a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>