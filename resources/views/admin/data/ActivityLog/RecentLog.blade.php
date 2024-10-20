<section id="activityLog">
    <div class="container">
        <h1>Activity Logs</h1>
        <div style="max-height: 400px; overflow-y: auto;"> <!-- Add a wrapper for scrolling -->
            <table id="logsTable" > <!-- Ensure the table takes full width -->
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Activity</th>
                        <th>User Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->activity_timestamp }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


<script>
    function fetchActivityLogs() {
        fetch('{{ route("admin.activity.logs") }}')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#logsTable tbody');
                // Clear existing rows
                tableBody.innerHTML = '';  // Clear previous rows

                // Append new rows
                data.forEach(log => {
                    const row = tableBody.insertRow();  // Create a new row
                    row.insertCell(0).textContent = log.activity_timestamp;
                    row.insertCell(1).textContent = log.activity;
                    row.insertCell(2).textContent = log.name;
                });
            })
            .catch(error => console.error('Error fetching logs:', error));
    }

    // Fetch logs every 5 seconds
    setInterval(fetchActivityLogs, 5000); // Set to 5000ms for real-time updates
</script>
