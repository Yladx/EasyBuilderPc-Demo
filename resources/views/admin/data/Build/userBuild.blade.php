<div class="container-fluid p-3 mt-4">
    <h4 class="fw-bold">User Builds</h4>

    @if($userbuilds->isNotEmpty())
    <div class="table-responsive">
        <table class="table" id="builds-table">
            <thead class="table-dark">
                <tr>
                    <th>Build ID</th>
                    <th>Build Name</th>
                    <th>Average Rating</th>
                    <th>Builder Name</th>
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
                @foreach($userbuilds as $build)
                <tr id="build-{{ $build->id }}" onclick="fetchBuildDetails({{ $build->id }})" style="cursor: pointer;">
                    <td>{{ $build->id }}</td>
                    <td>{{ $build->build_name }}</td>
                    <td>{{ isset($build->ratings_avg_rating) ? number_format($build->ratings_avg_rating, 2) : 'N/A' }}</td>
                    <td>{{ $build->user->name ?? 'N/A' }}</td>
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
</div>

<!-- Modal for build details -->
<div class="modal fade" id="buildDetailsModal" tabindex="-1" aria-labelledby="buildDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buildDetailsModalLabel">Build Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Build details will be dynamically loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


{{--
<script>
function fetchBuildDetails(buildId) {
    const modalBody = document.querySelector('#buildDetailsModal .modal-body');
    const modal = document.getElementById('buildDetailsModal');

    // Fetch the build details from the server
    fetch(`/builds/buildinfo/${buildId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            // Insert the modal content
            modalBody.innerHTML = data;
            // Show the modal
            const bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
        })
        .catch(error => {
            console.error('Error fetching build info:', error);
            modalBody.innerHTML = `<div class="alert alert-danger" role="alert">Failed to load build details. Please try again later.</div>`;
        });
}
</script> --}}
