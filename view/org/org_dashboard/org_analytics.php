<?php require_once  __DIR__ . '/../../_layout/layout.php'; ?>

<style>
    .chart-block {
        background: white;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-color: black;
    }

    .row {
        display: flex;
    }

    .column {
        margin-right: 1rem;
        flex: 30%;
    }

    .chart-heading {
        text-align: center;
        margin: 5px;
    }
</style>

<div style="padding-top: 2rem;">
    <div class="row">
        <div class="column">
            <div style="  padding: 0.5rem; margin: 10px;">
                <h4 class="chart-heading">Adoptees</h4>
                <canvas id="myChart1"></canvas>
            </div>

            <div style="  padding:0.5rem; margin: 10px;">
                <h4 class="chart-heading">Merchandiese Orders</h4>
                <canvas id="myChart2"></canvas>
            </div>

            <div style=" padding: 0.5rem; margin: 10px;">
                <h4 class="chart-heading">Sponsorships</h4>
                <canvas id="myChart3"></canvas>
            </div>
        </div>

        <div class="column">
            <div style="  padding: 0.5rem; margin: 10px;">
                <h4 class="chart-heading">Donations</h4>
                <canvas id="myChart4"></canvas>
            </div>

            <div style=" padding: 0.5rem; margin: 10px;">
                <h4 class="chart-heading">Rescues</h4>
                <canvas id="myChart5"></canvas>
            </div>
        </div>

        <div class="column">
            <div style="  padding: 0.5rem; margin: 10px;">
                <h4 class="chart-heading">Adoption Requests</h4>
                <canvas id="myChart6"></canvas>
            </div>

            <div style="   padding: 0.5rem; margin: 10px;">
                <h4 class="chart-heading">Annual Feedback Rating</h4>
                <canvas id="myChart7"></canvas>
            </div>
        </div>

    </div>


    <script>
        /*Chart 1*/
        Chart.defaults.font.family = "Roboto, sans-serif"
        Chart.defaults.color = '#000000'
        let labels1 = [
            'Dogs',
            'Cats',
            'Other'
        ];

        let data1 = [
            60, 50, 50
        ];

        let colors1 = [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ];

        let myChart1 = document.getElementById("myChart1").getContext('2d');

        let chart1 = new Chart(myChart1, {
            type: 'bar',
            data: {
                labels: labels1,
                axis: 'y',
                fill: true,
                datasets: [{
                    label: 'Male',
                    data: data1,
                    backgroundColor: colors1
                }]
            },
            options: {
                indexAxis: 'y',
                aspectRatio: 2.5,

                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        /*Chart 2*/

        let labels2 = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'June',
            'July',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        let data2 = [
            10, 30, 50, 75, 20, 50, 30, 80, 100, 40, 50, 70
        ];

        let colors2 = [
            'rgb(255, 99, 132)'
        ];

        let myChart2 = document.getElementById("myChart2").getContext('2d');

        let chart2 = new Chart(myChart2, {
            type: 'line',
            data: {
                labels: labels2,
                axis: 'y',
                fill: false,
                tension: 0.1,
                datasets: [{
                    label: 'Merchandise Orders',
                    data: data2,
                    backgroundColor: colors2
                }]
            },

            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                },
                aspectRatio: 2.5,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });

        /*Chart 3*/

        let labels3 = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'June',
            'July',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        let data3 = [
            10, 30, 50, 75, 20, 50, 30, 80, 100, 40, 50, 70
        ];

        let colors3 = [
            'rgb(54, 162, 235)'
        ];

        let myChart3 = document.getElementById("myChart3").getContext('2d');

        let chart3 = new Chart(myChart3, {
            type: 'line',
            data: {
                labels: labels3,
                axis: 'y',
                fill: false,
                tension: 0.1,
                datasets: [{
                    data: data3,
                    backgroundColor: colors3
                }]
            },
            options: {
                aspectRatio: 2.5,
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        });

        /*Chart 4*/

        let labels4 = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'June',
            'July',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        let data4 = [
            10, 30, 50, 75, 20, 50, 30, 80, 100, 40, 50, 70
        ];

        let colors4 = [
            'rgb(255, 205, 86)'
        ];

        let myChart4 = document.getElementById("myChart4").getContext('2d');

        let chart4 = new Chart(myChart4, {
            type: 'line',
            data: {
                labels: labels4,
                axis: 'y',
                fill: true,
                tension: 0.1,
                datasets: [{
                    label: 'Donations',
                    data: data4,
                    backgroundColor: colors4
                }]
            },
            options: {
                aspectRatio: 2.5,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        /*Chart 5*/

        let labels5 = [
            'Dogs',
            'Cats',
            'Other'
        ];

        let data5 = [
            60, 30, 20
        ];

        let colors5 = [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ];

        let myChart5 = document.getElementById("myChart5").getContext('2d');

        let chart5 = new Chart(myChart5, {
            type: 'pie',
            data: {
                labels: labels5,
                datasets: [{
                    data: data5,
                    backgroundColor: colors5
                }]
            },
            options: {
                aspectRatio: 1.1,
            }
        });

        /*Chart 6*/

        let labels6 = [
            'Dogs',
            'Cats',
            'Other'
        ];

        let data6 = [
            60, 50, 50
        ];

        let colors6 = [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ];

        let myChart6 = document.getElementById("myChart6").getContext('2d');

        let chart6 = new Chart(myChart6, {
            type: 'doughnut',
            data: {
                labels: labels6,
                datasets: [{
                    data: data6,
                    backgroundColor: colors6
                }]
            },
            options: {
                title: {
                    text: "Rescues",
                    display: true
                }
            },
            options: {
                aspectRatio: 1.2,
            }
        });

        /*Chart 7*/

        let labels7 = [
            '2019',
            '2020',
            '2021'
        ];

        let data7 = [
            4, 3.7, 5
        ];

        let colors7 = [
            'rgb(255, 99, 132)'
        ];

        let myChart7 = document.getElementById("myChart7").getContext('2d');

        let chart7 = new Chart(myChart7, {
            type: 'bar',
            data: {
                labels: labels7,
                axis: 'y',
                fill: true,
                datasets: [{
                    label: 'Annual Client Rating',
                    data: data7,
                    backgroundColor: colors7
                }]
            },
        });
    </script>