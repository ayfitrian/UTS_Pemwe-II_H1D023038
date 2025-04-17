<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Dashboard User</h1>

    <h2>Apakah Anda Sudah Memilih?</h2>
    <p>
        <?php if ($this->User_model->has_voted($this->session->userdata('user_id'))): ?>
            Anda sudah memilih!
        <?php else: ?>
            Silakan pilih kandidat di bawah ini:
            <form action="<?= site_url('dashboard/vote') ?>" method="post">
                <?php foreach ($candidates as $candidate): ?>
                    <input type="radio" name="candidate_id" value="<?= $candidate->id ?>"> <?= $candidate->name ?><br>
                <?php endforeach; ?>
                <button type="submit">Vote</button>
            </form>
        <?php endif; ?>
    </p>
</body>
</html>
