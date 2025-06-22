@extends('layouts.index')
@section('main-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="pagename">
    <p>Dashboard<p>
</div>

<div class="containerD">
    <div class="top-row">
        <div class="left-column">
        <div class="card card-1">
            <div class="time-container">
                <div id="clock"></div>
                <div>{{ now()->format('l, d M Y') }}</div>
            </div>
        </div>

        <div class="card card-2">
            <h5 class="card-title" style="text-align: center; font-weight:bold;">REGISTERED USERS BY ROLE</h5>

            <div class="card-content-flex">
                <div class="chart-container">
                   <canvas id="userChart"></canvas>
                </div>

                <div class="custom-labels">
                    <div class="label-row">
                        <div class="label-item" style="background-color:#9c827a;"></div>
                        <span>Admins</span>
                    </div>

                    <div class="label-row">
                        <div class="label-item" style="background-color:#3e2723;"></div>
                        <span>Residents</span>
                    </div>

                    <div class="label-row">
                        <div class="label-item" style="background-color:#80514a;"></div>
                        <span>Guards</span>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="right-column">
            <div class="card card-3">
            <h5 style="text-align: center; font-weight:bold;">RECENT ACTIVITIES</h5>

            <hr>

            <ul class="activity-list">
                @foreach($activities as $activity)
                    {{ $activity->description}}<br>
                    {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}

                    <hr>
                @endforeach
            </ul>
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

    document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('userChart').getContext('2d');

    new Chart(ctx,{
        type: 'doughnut',
        data: {

            labels:['Admins', 'Residents', 'Security Guards'],
            datasets: [{
                data:[{{ $adminCount }}, {{ $residentCount }}, {{ $guardCount }}],
                backgroundColor:['#9c827a', '#80514a', '#3e2723'],
                borderWidth: 1
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
        plugins: {
            legend: {
            display: false,
            },
            tooltip: {
                callbacks:{
                    label: function(context){
                        return `${context.label}: ${context.raw}`;
                    }
                }
            }
        }
        }
    });
});
</script>
@endsection
