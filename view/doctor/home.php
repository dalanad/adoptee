<?php
$active = "home";
require_once  __DIR__ . '/_nav.php';
?>
<style>
</style>
<div class="hed">
    <div>
        <div style="display:grid;grid-template-columns:2fr 4fr">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <div>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            Chart.defaults.font.family = "Roboto, sans-serif"
            Chart.defaults.color = '#000000'
            const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
            ];
            const data = {
                labels: labels,
                datasets: [{
                        label: 'Cats',
                        backgroundColor: '#ff829d',
                        borderColor: '#ff829d',
                        data: Array.from({
                            length: 6
                        }, (_, i) => Math.round(Math.random() * 30))
                    },
                    {
                        label: 'Dogs',
                        backgroundColor: '#ffd778',
                        borderColor: '#ffd778',
                        data: Array.from({
                            length: 6
                        }, (_, i) => Math.round(Math.random() * 30))
                    },
                    {
                        label: 'Birds',
                        backgroundColor: '#6fcdcd',
                        borderColor: '#6fcdcd',
                        data: Array.from({
                            length: 6
                        }, (_, i) => Math.round(Math.random() * 30))
                    },
                    {
                        label: 'Other',
                        backgroundColor: '#5eb5ef',
                        borderColor: '#5eb5ef',
                        data: Array.from({
                            length: 6
                        }, (_, i) => Math.round(Math.random() * 30))
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
                    aspectRatio: 1.05   ,
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
                            length: 30
                        }, (_, i) => {
                            let date = new Date()
                            date.setDate(date.getDate() - 30 + i)
                            return (date.getMonth() + 1) + '/' + date.getDate()
                        }),
                        datasets: [{
                                label: 'Live Consultations',
                                backgroundColor: '#5eb5ef',
                                borderColor: '#5eb5ef', cubicInterpolationMode: 'monotone',
                                data: Array.from({
                                    length: 30
                                }, (_, i) => Math.round(Math.random() * 8))
                            },
                            {
                                label: 'Medical Advice',
                                backgroundColor: '#ffd778',
                                borderColor: '#ffd778', cubicInterpolationMode: 'monotone',
                                data: Array.from({
                                    length: 30
                                }, (_, i) => Math.round(Math.random() * 12))
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