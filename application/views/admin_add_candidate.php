<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kandidat</title>
    <style>
        /* Reset default styles */
        body, h1, label, input, textarea, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fb;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #5D4B8D;
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Styling for form elements */
        label {
            font-size: 1.2em;
            margin-bottom: 10px;
            display: block;
            color: #5D4B8D;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
            background-color: #f9f9f9;
        }

        input:focus, textarea:focus {
            border-color: #5D4B8D;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        input[type="submit"] {
            background-color: #5D4B8D;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #4A3C7F;
            transform: translateY(-2px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        /* Flash message styling */
        p {
            font-size: 1.2em;
            color: #5D4B8D;
            background-color: #e6e6f1;
            border: 1px solid #d1d1e6;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Validation error styling */
        .validation-errors {
            font-size: 1.2em;
            color: #d9534f;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Tambah Kandidat</h1>

    <!-- Menampilkan pesan flash data -->
    <?php if ($this->session->flashdata('message')): ?>
        <p><?= $this->session->flashdata('message'); ?></p>
    <?php endif; ?>

    <!-- Menampilkan pesan validasi form -->
    <?= validation_errors('<div class="validation-errors">', '</div>'); ?>

    <form action="<?= site_url('dashboard/add_candidate') ?>" method="POST">
        <label for="name">Nama Kandidat:</label>
        <input type="text" name="name" id="name">
        <br>

        <label for="visi">Visi:</label>
        <textarea name="visi" id="visi"></textarea>
        <br>

        <label for="misi">Misi:</label>
        <textarea name="misi" id="misi"></textarea>
        <br>

        <input type="submit" value="Tambah Kandidat">
    </form>
</div>

</body>
</html>
