@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="pagename">
                <p>Dashboard</p>
            </div>
        </div>

        <div class="containerD">

                <div class=" card card-1">
                    <div class="time-container">
                        <small id="clock"></small><br>
                        <small>{{ now()->format('l, d M Y') }}</small><br>
                    </div>
                </div>

                <div class="card card-2" id="motion-card">
                <p id="motion-message">No Motion Detected</p>
                </div>

                <div class="card card-3" id="rfid-noti" style="transition: background 0.5s; height:460px; color:black;">
                    <p style="text-align: center;">RFID SCANNING </p>
                    <hr>
                    <p>Vehicle: <span id="rfid-result"></span></p>
                    <div id="authorized" style="display: none">
                    <p>Name: <span id="name"></span></p>
                    <p>Plate Number: <span id="plate">-</span></p>
                    <p>Home Address: <span id="address">-</span></p>
                    <p>Status: <span id="status">-</span></p>
                    </div>

                    <p id ="unauthorized" style="display: none"></p>
                </div>

                <div class="card card-4" id="rfid-no" style="transition: background 0.5s; height: 260px">
                    <h4>VEHICLE IN/OUT STATUS</h4>
                    <div class="flex-container">
                        <div class="chart-container mb-5">
                            <canvas id="inOutChart"  style="width:150px; height:150px;" ></canvas>
                        </div>
                        <div class="custom-labels mb-5">
                            <div class="label-row">
                                <div class="label-item" style="background-color:#5d4037;"></div>
                                <span>IN</span>
                            </div>
                            <div class="label-row">
                                <div class="label-item" style="background-color:#3e2723;"></div>
                                <span>OUT</span>
                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>




<script>

    //card 1
    function updateTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0'); // Format hours
        const minutes = now.getMinutes().toString().padStart(2, '0'); // Format minutes
        const timeString = `${hours}:${minutes} ${now.getHours() < 12 ? 'AM' : 'PM'}`; // Format time as HH:MM AM/PM

        document.getElementById('clock').textContent = timeString; // Update clock element with time
    }

    // Update time
    setInterval(updateTime, 60000);

    // call to display the time immediately
    updateTime();

    //Card 2
    function checkMotion(){
        fetch('/motion-status')
        .then(response => response.json())
        .then(data => {

            if(data.motion){
                document.getElementById('motion-message').textContent = 'Motion Detected';
                document.getElementById('motion-message').style.paddingTop = '20px';
                document.getElementById('motion-card').style.backgroundColor = '#FF0000'; //red background
                document.getElementById('motion-message').style.color = 'white';
            }

            setTimeout(() => {                                                         //back to norma;
                document.getElementById('motion-message').textContent = 'No Motion Detected';
                document.getElementById('motion-message').style.color = 'black';
                document.getElementById('motion-message').style.paddingTop = '0px';
                document.getElementById('motion-card').style.backgroundColor = '';

            }, 10000); // message reset after 10s
        })
        .catch(error => console.error('Error', error));
    }
    setInterval(checkMotion, 10000);

    //Card 3
    function fetchRFIDStatus(){
        fetch('/api/rfid/latest')
            .then(response => response.json())
            .then(data => {
                const resultEl = document.getElementById('rfid-result');
                const autheEl = document.getElementById('authorized');
                const unauthEl = document.getElementById('unauthorized');
                const rfidCard = document.getElementById('rfid-noti');

            // Reset all styles first
                rfidCard.style.backgroundColor = 'white';
                rfidCard.style.color='black';
                autheEl.style.display = 'none';
                unauthEl.style.display = 'none';

                //default
                if(!data || Object.keys(data).length == 0){
                resultEl.innerText = '';
                return;
                }

                //for authorized vehicle
                 if (data.authorized) {
                    resultEl.textContent = 'Authorized Vehicle';
                    autheEl.style.display = 'block';
                    rfidCard.style.backgroundColor= '#28a745';// green
                    rfidCard.style.color='white';
                    document.getElementById('name').textContent = data.Name;
                    document.getElementById('plate').textContent = data.PlateNo;
                    document.getElementById('address').textContent = data.Address;
                    document.getElementById('status').textContent = data.status;
                } else {
                    resultEl.textContent = 'Unauthorized Vehicle';
                    unauthEl.style.display='block';
                    unauthEl.textContent = 'Note : The vehicle is not registered. Please stop the vehicle for verification'
                    rfidCard.style.backgroundColor= '#FF0000';
                    rfidCard.style.color='white';
                }
            })
            .catch(error => {
                console.error('Error fetching RFID status:', error);
            });
    }

    setInterval(fetchRFIDStatus, 10000);
    fetchRFIDStatus();

    //card 4
    document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('inOutChart').getContext('2d');

    const inOutChart = new Chart(ctx,{
        type: 'doughnut',
        data:{
            labels: ['IN', 'OUT'],
            datasets: [{
                data:[0,0],
                backgroundColor:['#5d4037', '#3e2723'],

                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
    }
        }
    });

    function updateChart(){
        fetch('/api/vehicle-status')
        .then(response => response.json())
        .then(data => {
            inOutChart.data.datasets[0].data = [data.IN,data.OUT];
            inOutChart.update();
        })
        .catch(error => {
                console.error('Error fetching status:', error);
        });
    }
    // Initial fetch
    updateChart();

    // Poll every 10 seconds
    setInterval(updateChart, 10000);
    });
</script>
@endsection
