<div class="container">
    <h2>Build Counts</h2>
    <table class="table" id="build-counts-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            @if($buildCounts->isEmpty())
                <tr>
                    <td colspan="2">No build counts available.</td>
                </tr>
            @else
                @foreach($buildCounts as $buildCount)
                    <tr>
                        <td>{{ $buildCount->row_name }}</td>
                        <td>{{ $buildCount->total_count }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchBuildCounts(); // Initial fetch of build counts

        function fetchBuildCounts() {
            fetch('/admin/build-counts') // Adjust this URL to your route
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {

                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }



    });
</script>
