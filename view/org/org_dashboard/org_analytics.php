<?php require_once  __DIR__ . '/../../_layout/layout.php'; ?>

<style>
     .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        margin: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
        position: absolute;
    }

    .row {
        display: flex;
    }

    .column1 {
        margin-right: 1rem;
        flex: 30%;
    }

    .column2 {
        margin-right: 1rem;
        flex: 50%;
    }

    .div-totals {
        padding: 0.5rem;
        margin: 20px;
        width: 275px;
        height: 40px;
        border-radius: 0.2rem;
        display: flex;
        font-weight: 1000;
        font-size: 1.5rem;

    }

    .div-edge {
        height: 40px;
        width: 5px;
        border-radius: 0.2rem;
    }

    .div-totals:hover {
        opacity: .84;
    }

    .div-heading {
        text-align: center;
        margin: 5px;
    }
</style>

<div style="padding-top: 2rem;">
    <div class="row">
        <div class="column1"><button onclick="showModel('popupModal-report')" class="btn outline button-hover">Generate Report</button>
            <div id="popupModal-report" class="modal">
                <div class="modal-content" style="height: 150px; width: 930px; top: 40%; left: 50%">
                    <span class="close" onclick="hideModel('popupModal-report')">&times;</span>
                    <h3 style="text-align: center;">Select report type</h3>
                    <div style="justify-items:center; align-items:center; display:flex;">
                    <a href="/OrgManagement/animals_report" class="btn green" style="bottom: 25px; width: 80px">Animal Report</a>&emsp;&emsp;
                    <a href="/OrgManagement/adoption_requests_report" class="btn pink" style="bottom: 25px; width: 80px">Adoption Requests Report</a>&emsp;&emsp;
                    <a href="" class="btn blue" style="bottom: 25px; width: 80px">Rescue Report</a>&emsp;&emsp;
                    <a href="" class="btn orange" style="bottom: 25px; width: 80px">Donation Report</a>&emsp;&emsp;
                    <a href="" class="btn" style="bottom: 25px; width: 80px;">General Summary</a>&emsp;&emsp;
                    </div>
                    
        </div>
            </div>
    </div>

            </div>

            <div class="row">
                <div class="column1">
                    <div style="padding: 0.5rem; margin: 10px;">
                        <canvas id="myChart1"></canvas>
                    </div>

                    <div style="padding:0.5rem; margin: 10px;">
                        <canvas id="myChart5"></canvas>
                    </div>
                </div>

                <div class="column2">
                    <div class="row">
                        <div class="column1" style="flex: 70%;">
                            <div style="padding: 0.5rem; margin: 10px;">
                                <canvas id="myChart6"></canvas>
                            </div>
                        </div>
                        <div class="column1" style="padding: .5rem;">
                            <div class="div-totals" style="background-color:#e2f5f5; justify-items:center; align-items:center; padding-left: .5rem;">
                                <div style="justify-items:center; align-items:center; display:flex; font-size:0.7rem; width: 90px; height:20px; border-radius: 5rem; background-color:#6fcdcd; padding-left: .6rem;"><i class="fa fa-hand-holding-usd"></i>&nbsp;Donations</div>&nbsp;&nbsp;
                                <div>
                                    <div style="font-size: 1.5rem; padding-top:5px;">Rs. 41,200</div>
                                    <div style="font-size: 0.7rem; font-weight: 400; padding-bottom:5px;">All time donations received</div>
                                </div>
                            </div>
                            <div class="div-totals" style="background-color:#ffe6eb; justify-items:center; align-items:center;padding-left: .5rem;">
                                <div style="justify-items:center; align-items:center; display:flex; font-size:0.7rem; width: 90px; height:20px; border-radius: 5rem; background-color:#ff829d; padding-left: .6rem;"><i class="fa fa-donate"></i>&nbsp;Sponsorships</div>&nbsp;&nbsp;
                                <div>
                                    <div style="font-size: 1.5rem; padding-top:5px;">Rs. 140,200</div>
                                    <div style="font-size: 0.7rem; font-weight: 400;  padding-bottom:5px;">All time sponsorships received</div>
                                </div>
                            </div>
                            <div class="div-totals" style="background-color:#fff3d7; justify-items:center; align-items:center;padding-left: .5rem;">
                                <div style="justify-items:center; align-items:center; display:flex; font-size:0.7rem; width: 90px; height:20px; border-radius: 5rem; background-color:#ffd778; padding-left: .8rem;"><i class="fa fa-tshirt"></i>&nbsp;Orders</div>&nbsp;&nbsp;
                                <div>
                                    <div style="font-size: 1.5rem; padding-top:5px;">151</div>
                                    <div style="font-size: 0.7rem; font-weight: 400;  padding-bottom:5px;">Completed orders</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 0.5rem; margin: 10px;">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>

            </div>


            <script>
                Chart.defaults.font.family = "Roboto, sans-serif"
                Chart.defaults.color = '#000000'

                /*Chart 1*/
                let labels1 = [
                    'Dogs',
                    'Cats',
                    'Other'
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
                                backgroundColor: '#5eb5ef',
                                borderColor: '#5eb5ef',
                                data: Array.from({
                                    length: 6
                                }, (_, i) => Math.round(Math.random() * 30))
                            },
                            {
                                label: 'Female',
                                backgroundColor: '#ff829d',
                                borderColor: '#ff829d',
                                data: Array.from({
                                    length: 6
                                }, (_, i) => Math.round(Math.random() * 30))
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y',
                        plugins: {
                            title: {
                                display: true,
                                text: 'Adoptees'
                            },
                            subtitle: {
                                display: true,
                                text: 'By Gender'
                            }
                        },
                        aspectRatio: 2.6,
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
                });

                /* Chart 2 */

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

                let myChart2 = document.getElementById("myChart2").getContext('2d');

                let chart2 = new Chart(myChart2, {
                    type: 'line',
                    data: {
                        labels: labels2,
                        datasets: [{
                                label: 'Donations',
                                backgroundColor: '#ff829d',
                                borderColor: '#ff829d',
                                cubicInterpolationMode: 'monotone',
                                data: Array.from({
                                    length: 30
                                }, (_, i) => Math.round(Math.random() * 8))
                            },
                            {
                                label: 'Sponsorships',
                                backgroundColor: '#6fcdcd',
                                borderColor: '#6fcdcd',
                                cubicInterpolationMode: 'monotone',
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
                                text: 'Donations and Sponsorships'
                            },
                            subtitle: {
                                display: true,
                                text: 'Past 12 Months'
                            }
                        },
                        aspectRatio: 2.6,
                        responsive: true,
                        interaction: {
                            intersect: false,
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
                    'rgb(255, 130, 157)',
                    'rgb(255, 215, 120)',
                    'rgb(111, 205, 205)'
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
                        aspectRatio: 1.3,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Rescues'
                            },
                            subtitle: {
                                display: true,
                                text: 'By Animal Type'
                            }
                        }
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
                    'rgb(255, 130, 157)',
                    'rgb(255, 215, 120)',
                    'rgb(94, 181, 239)'
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
                        aspectRatio: 1.4,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Adoption Requests'
                            },
                            subtitle: {
                                display: true,
                                text: 'By Animal Type'
                            }
                        }
                    }
                });
            </script>

<script>
    function displayPreview(_this) {
        var prev = document.getElementsByClassName('preview')[0];
        var thumb = _this.style.backgroundImage;
        prev.style.backgroundImage = thumb;
    }

    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-content' || 'update-form')) {
                let model = document.querySelector('.modal.shown');
                model.style.display = "none"
                model.classList.remove("shown")
                document.getElementById(id).onclick = null
            }
        }
    }

    function hideModel(id) {
        document.getElementById(id).classList.remove("shown")
        document.getElementById(id).style.display = "none";
        document.getElementById(id).onclick = null
    }

    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".box").hide();
                }
            });
        }).change();
    });

    //Max Date input
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("max", today);
</script>