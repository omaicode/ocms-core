<script>
    function initSessionChart() {
        const ctx = document.getElementById('session-chart');
        new Chart(ctx, {
            type: 'line',
            data: {
            labels: {!! json_encode($analytics->pluck('date')->toArray()) !!},
            datasets: [{
                label: 'Views',
                data: {{ json_encode($analytics->pluck('visitors')->map(fn($x) => \Carbon\Carbon::parse($x)->format('Y-m-d H:i:s'))->toArray()) }},
                borderWidth: 1
            }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });        
    }

    initSessionChart();
</script>