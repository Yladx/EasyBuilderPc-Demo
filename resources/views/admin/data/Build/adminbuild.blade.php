<div class="container-fluid p-3">
    <h4 class="fw-bold">Recommended Build</h4>

    @if($builds->isNotEmpty())
    <div class="table-responsive">
        <table class="table" id="builds-table">
            <thead class="table-dark">
                <tr>
                    <th>Build ID</th>
                    <th>Build Name</th>
                    <th>Average Rating</th>
                    <th>IsPublished </th>
                    <th>CPU</th>
                    <th>GPU</th>
                    <th>Motherboard</th>
                    <th>RAM</th>
                    <th>Storage</th>
                    <th>Power Supply</th>
                    <th>Case</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($builds as $build)
                <tr id="build-{{ $build->id }}">
                    <td>{{ $build->id }}</td>
                    <td>{{ $build->build_name  }}</td>
                    <td>{{ isset($build->ratings_avg_rating) ? number_format($build->ratings_avg_rating, 2) : 'N/A' }}</td>
                    <td>{{ $build->published  }}</td>
                    <td>{{ $build->cpu ? $build->cpu->name : 'No CPU' }}</td>
                    <td>{{ $build->gpu ? $build->gpu->name : 'No GPU' }}</td>
                    <td>{{ $build->motherboard ? $build->motherboard->name : 'No Motherboard' }}</td>
                    <td>{{ $build->ram ? $build->ram->name : 'No RAM' }}</td>
                    <td>{{ $build->storage ? $build->storage->name : 'No Storage' }}</td>
                    <td>{{ $build->powerSupply ? $build->powerSupply->name : 'No Power Supply' }}</td>
                    <td>{{ $build->pcCase ? $build->pcCase->name : 'No Case' }}</td>
                    <td>
                        <button onclick="deleteBuild({{ $build->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    @else
        <p>No builds available.</p>
    @endif

    <!-- Button to trigger modal -->
    <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#buildrecommendModal">Create New Build</button>

</div>

<script>
    function deleteBuild(buildId) {
        if (confirm("Are you sure you want to delete this build?")) {
            fetch(`/admin/builds/${buildId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById(`build-${buildId}`).remove(); // Remove the deleted row from the table
                    alert('Build deleted successfully.'); // Consider using a toast notification instead
                } else {
                    alert('Failed to delete build.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the build.');
            });
        }
    }
</script>
