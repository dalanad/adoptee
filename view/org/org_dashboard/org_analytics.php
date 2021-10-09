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
</style>

<div style="padding-top: 10px; padding-bottom: 30px; padding-left: 50px; padding-right: 50px;">
    <!-- <i class="far fa-chart-line"> -->
    <h2>Organization Analytics</h2>

    <div class="row">
        <div class="column">
            <div class="chart-block" style="width: 400px; height: 30%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart1"></canvas>
            </div>

            <div class="chart-block" style="width: 400px; height: 30%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart2"></canvas>
            </div>

            <div class="chart-block" style="width: 400px; height: 30%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart3"></canvas>
            </div>
        </div>

        <div class="column">
            <div class="chart-block" style="width: 400px; height: 30%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart4"></canvas>
            </div>

            <div class="chart-block" style="width: 400px; height: 60%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart5"></canvas>
            </div>
        </div>

        <div class="column">
            <div class="chart-block" style="width: 400px; height: 60%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart6"></canvas>
            </div>

            <div class="chart-block" style="width: 400px; height: 30%; padding: 0.5rem; margin: 10px;">
                <canvas id="myChart7"></canvas>
            </div>
        </div>

    </div>


    <script>
        /*Chart 1*/

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
                indexAxis: 'y'
            }
        });

        /*Chart 2*/

        let labels2 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
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
        });

        /*Chart 3*/

        let labels3 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
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
                    label: 'Sponsorships',
                    data: data3,
                    backgroundColor: colors3
                }]
            },
        });

        /*Chart 4*/

        let labels4 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
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