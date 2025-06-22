@extends('layouts.app')

@section('content')

    <div class="container">

            <div class="pagename">
                <p>Vehicle Log</p>
            </div>
            <div class="searchB">
                <input type="text" id="search-name" placeholder="Search" class="form-control mb-3" />
                <input type="date" id="search-date" class="form-control mb-3" onchange="fetchLogsByDate()" />
            </div>

            <div class="d-flex justify-content-center mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>License Plate</th>
                            <th>Date, Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody id="log-table-body">
                        @foreach($logs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $log->resident->Name ?? 'UNKNOWN' }}</td>
                                <td>{{ $log->resident->PlateNo ?? '-' }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <ul class="pagination" id="pagination"></ul>
            </div>
    </div>

    <script>
        const nameInput = document.getElementById('search-name');
        const dateInput = document.getElementById('search-date');

        function fetchLogs(page = 1){
            const name = nameInput.value;
            const date = dateInput.value;

            fetch(`/api/logs/search?name=${name}&date=${date}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('log-table-body');
                    tbody.innerHTML = ''; //clear table

                    data.data.forEach((log, index) => {
                        const rowNumber = (data.current_page - 1) * data.per_page + (index + 1);
                        const row = `
                        <tr>
                            <td>${rowNumber}</td>
                            <td>${log.Name}</td>
                            <td>${log.PlateNo}</td>
                            <td>${new Date(log.created_at).toLocaleString()}</td>
                            <td>${log.status}</td>
                        </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                    renderPagination(data);
                })
                .catch(error => console.error('Error:', error));
        }

        function renderPagination(data) {
        let pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

            for (let page = 1; page <= data.last_page; page++) {
                pagination.innerHTML += `
                    <li class="page-item ${page === data.current_page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="fetchLogs(${page})">${page}</a>
                    </li>
                `;
            }
        }

        nameInput.addEventListener('input', fetchLogs);
        dateInput.addEventListener('change', fetchLogs);


        window.onload = () => {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('search-date').value = today;
        fetchLogs(); // Auto-load
        };

    </script>

@endsection
