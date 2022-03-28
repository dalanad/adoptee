<?php
$active = "home";
require_once  __DIR__ . '/_nav.php';

$months = [];
$dt = strtotime(date('Y-m-01'));
for ($j = 0; $j <= 5; $j++) {
    array_push($months, date("F", strtotime(" -$j month", $dt)));
}

$months = array_reverse($months);

?>

<style>
</style>
<div class="hed">
    <div>
        <div class="chart-grid">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <div>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <style>
            .chart-grid {
                display: grid;
                grid-template-columns: 2fr 4fr
            }

            @media screen and (max-width:600px) {
                .chart-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
        <script src="/assets/vendor/charts.js"></script>
        <script>
            Chart.defaults.font.family = "Roboto, sans-serif"
            Chart.defaults.color = '#000000'
            const labels = <?= json_encode($months) ?>;
            const data = {
                labels: labels,
                datasets: [{
                        label: 'Cats',
                        backgroundColor: '#ff829d',
                        borderColor: '#ff829d',
                        data: <?= json_encode($monthly["cats"]) ?>
                    },
                    {
                        label: 'Dogs',
                        backgroundColor: '#ffd778',
                        borderColor: '#ffd778',
                        data: <?= json_encode($monthly["dogs"]) ?>
                    }, {
                        label: 'Other',
                        backgroundColor: '#5eb5ef',
                        borderColor: '#5eb5ef',
                        data: <?= json_encode($monthly["other"]) ?>
                    }
                ]
            };
            const config = {
                type: 'bar',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Consultations'
                        },
                        subtitle: {
                            display: true,
                            text: 'By Animal Type'
                        }
                    },
                    aspectRatio: 1.05,
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true
                        }
                    }
                }
            };
            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );

            var myChart = new Chart(
                document.getElementById('myChart2'), {
                    type: 'line',
                    data: {
                        labels: Array.from({
                            length: 31
                        }, (_, i) => {
                            let date = new Date()
                            date.setDate(date.getDate() - 30 + i)
                            return (date.getMonth() + 1) + '/' + date.getDate()
                        }),
                        datasets: [{
                                label: 'Live Consultations',
                                backgroundColor: '#5eb5ef',
                                borderColor: '#5eb5ef',
                                cubicInterpolationMode: 'monotone',
                                data: <?= json_encode($consultations["live"]) ?>
                            },
                            {
                                label: 'Medical Advice',
                                backgroundColor: '#ffd778',
                                borderColor: '#ffd778',
                                cubicInterpolationMode: 'monotone',
                                data: <?= json_encode($consultations["advise"]) ?>
                            },
                        ]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Daily Consultations'
                            },
                            subtitle: {
                                display: true,
                                text: 'last 30 days'
                            }
                        },
                        aspectRatio: 2,
                        responsive: true,
                        interaction: {
                            intersect: false,
                        }

                    }
                }
            );
        </script>