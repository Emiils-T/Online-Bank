<div style="width: 80%; margin: auto;">
    <canvas id="cryptoWalletChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("test") }}')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('cryptoWalletChart').getContext('2d');

                console.log('Received data:', data);

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.map(item => item.currency),
                        datasets: [{
                            data: data.map(item => item.valueNow),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Crypto Wallet Distribution'
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    });
</script>
