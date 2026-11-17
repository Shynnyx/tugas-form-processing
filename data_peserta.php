
<?php
require_once "koneksi.php";

// Mengambil seluruh data peserta
$query = "SELECT * FROM peserta ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// Menghitung statistik
$total = mysqli_num_rows($result);
$lulus = 0;
$remedial = 0;

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;

    if ($row["status"] === "Lulus") {
        $lulus++;
    } else {
        $remedial++;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Ujian</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1efff;
            padding: 35px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            color: #39345c;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #888;
            margin-bottom: 25px;
        }

        .statistics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        }

        .card p {
            color: #888;
            margin-bottom: 10px;
        }

        .card h2 {
            color: #7665d8;
        }

        .table-container {
            background: white;
            padding: 25px;
            border-radius: 14px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
            white-space: nowrap;
        }

        th {
            background: #f8f7ff;
            color: #51467f;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .success {
            background: #e8f8ee;
            color: #21864b;
        }

        .danger {
            background: #fff0f0;
            color: #d94343;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #7665d8;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        @media (max-width: 600px) {
            .statistics {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Data Peserta Ujian</h1>
    <p class="subtitle">
        Daftar seluruh peserta yang telah mengikuti ujian.
    </p>

    <div class="statistics">

        <div class="card">
            <p>Total Peserta</p>
            <h2><?= $total ?></h2>
        </div>

        <div class="card">
            <p>Peserta Lulus</p>
            <h2><?= $lulus ?></h2>
        </div>

        <div class="card">
            <p>Peserta Remedial</p>
            <h2><?= $remedial ?></h2>
        </div>

    </div>

    <div class="table-container">

        <h2>Daftar Peserta</h2>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nilai</th>
                    <th>Status</th>
                    <th>Tanggal Submit</th>
                </tr>
            </thead>

            <tbody>

                <?php if ($total > 0): ?>

                    <?php foreach ($data as $index => $peserta): ?>

                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($peserta["nama"]) ?></td>
                            <td><?= htmlspecialchars($peserta["email"]) ?></td>
                            <td><?= $peserta["nilai"] ?></td>
                            <td>
                                <?php if ($peserta["status"] === "Lulus"): ?>
                                    <span class="badge success">Lulus</span>
                                <?php else: ?>
                                    <span class="badge danger">Remedial</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($peserta["tanggal_submit"]) ?></td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" style="text-align:center">
                            Belum ada data peserta.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

        <a href="index.php" class="button">
            Kembali ke Form
        </a>

    </div>

</div>

</body>
</html>
