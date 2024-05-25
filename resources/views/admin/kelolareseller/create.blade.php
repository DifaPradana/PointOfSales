<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Reseller</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
        }

        div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Pendaftaran Reseller</h1>
    <form action="/submit-your-registration-url" method="post">
        <div>
            <label for="nama_reseller">Nama Reseller:</label>
            <input type="text" id="nama_reseller" name="nama_reseller" required>
        </div>
        <div>
            <label for="kata_sandi">Kata Sandi:</label>
            <input type="password" id="kata_sandi" name="kata_sandi" required>
        </div>
        <div>
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea>
        </div>
        <div>
            <button type="submit">Daftar</button>
        </div>
    </form>
</body>
</html>
