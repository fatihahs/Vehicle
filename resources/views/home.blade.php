@extends('layouts.app')

@section('content')
<body>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="pagename">
                <p>Dashboard<p>
            </div>
        </div>

        <div class="grid">
            <!-- First row -->
            <div class="card card-1">
                <div class="time-container">
                    <small id="clock"></small><br>
                    <small>{{ now()->format('l, d M Y') }}</small><br>
                </div>
            </div>

            <div class="card card-2">
            <p>
            </p>

            </div>

            <div class="card card-3">
                <h4>Today Logs</h4>

                    Name:
                    Plate No:
                    Address:

            </div>

            <!-- Second row -->
            <div class="card card-4">
                <h4>Notifikasi</h4>
                <p>Tiada mesej baru</p>
            </div>
        </div>




<script>
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

    setTimeout(() => {
        window.location.href = window.location.href;
    }, 5000); // 5 seconds

</script>
</body>
@endsection
