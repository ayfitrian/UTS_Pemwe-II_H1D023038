<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 50px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #ff69b4; /* Nuansa pink */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #ff1493;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- Menampilkan pesan error jika login gagal -->
        <?php if ($this->session->flashdata('error')): ?>
            <p style="color: red;"><?= $this->session->flashdata('error'); ?></p>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>

        <p>Belum punya akun? <a href="<?= site_url('auth/register') ?>">Daftar di sini</a></p>
    </div>
</body>
</html>
