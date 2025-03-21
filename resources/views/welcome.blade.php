<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel - Rounded Line Chart</title> 

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div style="width: 80%; margin: 0 auto;">
                <canvas id="roundedLineChart"></canvas>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('roundedLineChart').getContext('2d');
    
                fetch("{{ route('chart.data') }}")
                    .then(response => response.json())
                    .then(data => {
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.labels, // Dynamic labels from API
                                datasets: [
                                    {
                                        label: 'Rounded Line Dataset',
                                        data: data.lineData, // Dynamic data from API
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderWidth: 2,
                                        tension: 0.6, // Smoothness of the line (rounded effect)
                                        fill: true, // Optional: Fill area under the line
                                        pointRadius: 5, // Point size
                                        pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    tooltip: {
                                        enabled: true // Show tooltips on hover
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Months'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Values'
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching chart data:', error));
            });
        </script>
    </body>
</html>
