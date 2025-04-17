<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Reset default styles */
        body, h1, h2, table, th, td, a {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fb;
            color: #333;
            line-height: 1.6;
        }

        h1, h2 {
            color: #333;
        }

        /* Container for the page */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Header */
        h1 {
            text-align: center;
            background-color: #5D4B8D;
            color: white;
            padding: 25px;
            border-radius: 10px;
            font-size: 2.5em;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Table styling */
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5D4B8D;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f4f6f9;
        }

        table tr:hover {
            background-color: #f1f3f5;
            transition: background-color 0.3s;
        }

        /* Button styling */
        a {
            padding: 10px 15px;
            background-color: #5D4B8D;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #4A3C7F;
            transform: translateY(-2px);
        }

        a:active {
            transform: translateY(0);
        }

        /* Chart section */
        #voteChart {
            width: 100%;
            max-width: 900px;
            margin-top: 50px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .section-title {
            margin-top: 50px;
            color: #333;
            font-size: 1.8em;
            font-weight: 600;
        }

        .btn {
            padding: 10px 15px;
            background-color: #ff69b4;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #ff1493;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* Alert styling */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #4CAF50;
            color: white;
        }

        .alert-danger {
            background-color: #f44336;
            color: white;
        }

    </style>
</head>
<body>

<div class="container">

    <h1>Admin Dashboard</h1>

    <!-- Alert for success or error -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Tabel Kandidat -->
    <h2 class="section-title">Kandidat</h2>
    <a href="<?= site_url('dashboard/add_candidate') ?>" class="btn">Tambah Kandidat</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidates as $candidate): ?>
                <tr>
                    <td><?= $candidate->id ?></td>
                    <td><?= $candidate->name ?></td>
                    <td><?= $candidate->visi ?></td>
                    <td><?= $candidate->misi ?></td>
                    <td>
                        <a href="<?= site_url('dashboard/edit_candidate/' . $candidate->id) ?>" class="btn btn-warning">Edit</a> |
                        <a href="<?= site_url('dashboard/delete_candidate/' . $candidate->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Grafik Statistik -->
    <h2 class="section-title">Statistik Pemilihan</h2>
    <canvas id="voteChart" width="400" height="200"></canvas>
    <script>
        var ctx = document.getElementById('voteChart').getContext('2d');
        var voteData = <?= $chart_data ?>;
        var labels = voteData.map(function(stat) {
            return stat.candidate_name;
        });
        var data = voteData.map(function(stat) {
            return stat.votes;
        });

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Suara',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>

</div>

</body>
</html>
