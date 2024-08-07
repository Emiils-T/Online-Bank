<div style="width: 50%; margin: auto;">
    <canvas id="cryptoChart"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('cryptoChart').getContext('2d');
        var cryptoData = @json($cryptoHoldings);
        var labels = cryptoData.map(function(item) { return item.name; });
        var data = cryptoData.map(function(item) { return item.value; });

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
    });
</script>
