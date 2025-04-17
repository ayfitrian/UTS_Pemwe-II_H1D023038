<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kandidat</title>
</head>
<body>
    <h1>Edit Kandidat</h1>

    <!-- Menampilkan pesan flash data -->
    <?php if ($this->session->flashdata('message')): ?>
        <p><?= $this->session->flashdata('message'); ?></p>
    <?php endif; ?>

    <!-- Menampilkan pesan validasi form -->
    <?= validation_errors(); ?>

    <form action="<?= site_url('dashboard/edit_candidate/' . $candidate->id) ?>" method="POST">
        <label for="name">Nama Kandidat:</label>
        <input type="text" name="name" id="name" value="<?= set_value('name', $candidate->name) ?>" required><br><br>
        
        <label for="visi">Visi:</label>
        <textarea name="visi" id="visi" required><?= set_value('visi', $candidate->visi) ?></textarea><br><br>

        <label for="misi">Misi:</label>
        <textarea name="misi" id="misi" required><?= set_value('misi', $candidate->misi) ?></textarea><br><br>
        
        <button type="submit">Update Kandidat</button>
    </form>
</body>
</html>
