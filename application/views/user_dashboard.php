<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <style>
        /* Umum */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        /* Tombol dan link */
        button, a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover, a:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        button:active, a:active {
            transform: translateY(2px);
        }

        /* Form vote */
        input[type="radio"] {
            margin: 10px 0;
        }

        /* Logout link */
        .logout-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .logout-link a {
            color: #3498db;
            text-decoration: none;
        }

        .logout-link a:hover {
            color: #2980b9;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .card {
                padding: 20px;
                width: 90%;
            }

            .card h2 {
                font-size: 20px;
            }

            button, a {
                width: 100%;
                padding: 12px 0;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Dashboard User</h2>

    <p>
        <?php if ($this->User_model->has_voted($this->session->userdata('user_id'))): ?>
            Anda sudah memilih kandidat.<br>
            <a href="<?= site_url('dashboard/vote_stats') ?>">Lihat Statistik Voting</a>
        <?php else: ?>
            Silakan pilih kandidat di bawah ini:
            <form action="<?= site_url('dashboard/vote_candidate') ?>" method="post">
                <?php foreach ($candidates as $candidate): ?>
                    <input type="radio" name="candidate_id" value="<?= $candidate->id ?>" required> <?= $candidate->name ?><br>
                <?php endforeach; ?>
                <button type="submit">Vote</button>
            </form>
        <?php endif; ?>
    </p>

    <p class="logout-link"><a href="<?= site_url('auth/logout') ?>">Logout</a></p>
</div>

</body>
</html>
