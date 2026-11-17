
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penilaian Ujian</title>

    <style>

         .link-data {
            display: block;
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            color: #7665d8;
            text-decoration: none;
            border: 1px solid #7665d8;
            border-radius: 10px;
}

        .link-data:hover {
            background: #f1efff;
}

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
            max-width: 450px;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #39345c;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 30px;
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #7665d8;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #7665d8;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #5d4bc0;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Form Penilaian Ujian</h1>
        <p class="subtitle">
            Silakan isi data diri dan nilai ujian Anda.
        </p>

        <form action="proses.php" method="POST">

            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama"
                   placeholder="Masukkan nama lengkap" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   placeholder="contoh@email.com" required>

            <label for="nilai">Nilai Ujian (0-100)</label>
            <input type="number" id="nilai" name="nilai"
                   min="0" max="100"
                   placeholder="Masukkan nilai ujian" required>

            <button type="submit">Kirim Penilaian</button>

        </form>

        <a href="data_peserta.php" class="link-data"> Lihat Data Peserta </a>

    </div>

</body>
</html>
