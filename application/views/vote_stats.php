<!DOCTYPE html>
<html>
<head>
    <title>Statistik Voting</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Statistik Voting Kandidat</h1>
    <canvas id="voteChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('voteChart').getContext('2d');
        const voteChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($candidates, 'name')) ?>,
                datasets: [{
                    label: 'Jumlah Suara',
                    data: <?= json_encode(array_column($candidates, 'votes')) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
