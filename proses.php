<?php
// Menghubungkan ke database
require_once "koneksi.php";

// Memastikan form dikirim menggunakan POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Mengambil data dari form
$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$nilai = $_POST["nilai"] ?? "";

// Validasi data
if ($nama === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || $nilai === "" || !is_numeric($nilai)
    || $nilai < 0 || $nilai > 100) {
    die("Data tidak valid. Silakan kembali dan periksa form.");
}

$nilai = (int) $nilai;

// Menentukan status kelulusan
if ($nilai >= 70) {
    $status = "Lulus";
    $warna = "success";
    $pesan = "Selamat! Kamu berhasil melewati ujian.";
} else {
    $status = "Remedial";
    $warna = "danger";
    $pesan = "Jangan menyerah! Tetap semangat belajar.";
}

// Menyimpan data ke database
$query = "INSERT INTO peserta (nama, email, nilai, status)
          VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "ssis",
    $nama,
    $email,
    $nilai,
    $status
);

if (!mysqli_stmt_execute($stmt)) {
    die("Gagal menyimpan data: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);

// Mengamankan output
$nama = htmlspecialchars($nama);
$email = htmlspecialchars($email);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian Ujian</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1efff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            width: 100%;
            max-width: 480px;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        h1 {
            color: #39345c;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 30px;
        }

        .data {
            background: #f8f7ff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .data p {
            margin: 12px 0;
            color: #555;
        }

        .status {
            text-align: center;
            padding: 22px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .success {
            background: #e8f8ee;
            color: #21864b;
        }

        .danger {
            background: #fff0f0;
            color: #d94343;
        }

        .status h2 {
            margin-bottom: 10px;
        }

        .button {
            display: block;
            text-align: center;
            text-decoration: none;
            background: #7665d8;
            color: white;
            padding: 14px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Hasil Penilaian</h1>
        <p class="subtitle">Data berhasil disimpan!</p>

        <div class="data">
            <p><strong>Nama:</strong> <?= $nama ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Nilai Ujian:</strong> <?= $nilai ?></p>
        </div>

        <div class="status <?= $warna ?>">
            <h2><?= strtoupper($status) ?></h2>
            <p><?= $pesan ?></p>
        </div>

        <a href="index.php" class="button">
            Kembali ke Form
        </a>

    </div>
</body>
</html>
