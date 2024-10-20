@extends('components.layout')

@section('title', 'Builds')

@section('content')
    @include('components.userheader')

    <div class="container mt-4">
        <div>
            <nav class="nav" id="builds-nav">
                <a class="nav-link active" href="#" data-tag="" aria-current="page">All</a>
                <a class="nav-link" href="#" data-tag="recommended">Recommended</a>
                <a class="nav-link" href="#" data-tag="gaming">Gaming</a>
                <a class="nav-link" href="#" data-tag="office">Office</a>
                <a class="nav-link" href="#" data-tag="school">School</a>
            </nav>
        </div>

        <!-- Search Bar -->
        <div class="mt-4">
            <input type="text" id="search-input" class="form-control" placeholder="Search builds..." />
        </div>

        <div class="row mt-4" id="builds-container">
            @if($displaybuilds->isEmpty())
                <div class="col-12">
                    <p>No builds found for this category.</p>
                </div>
            @else
                @foreach($displaybuilds as $build)
                    <div class="col-md-4 mb-4 build-item" data-name="{{ strtolower($build->build_name) }}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $build->build_name }}</h5> <!-- Build name -->
                                <p class="card-title">{{ $build->tag }}</p> <!-- Tag -->
                                <p>Rating: {{ $build->average_rating ? number_format($build->average_rating, 2) : 'No ratings yet' }}</p>
                                <p class="card-text">{{ $build->build_note }}</p> <!-- Build note/description -->

                                <!-- Button to open the modal and pass build ID to the modal -->
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buildDetailsModal" data-build-id="{{ $build->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
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

    <div class="position-fixed bottom-0 end-0 p-3">
        <a href="{{ route('userbuild') }}" class="btn btn-primary">
            <i class="fas fa-chevron-up"></i> Manage Your Builds
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('buildDetailsModal');
            const modalBody = modal.querySelector('.modal-body');

            // Listen for when the modal is triggered to open
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // The button that triggered the modal
                const buildId = button.getAttribute('data-build-id'); // Get the build ID from the button

                // Fetch the build details from the server
                fetch(`/builds/buildinfo/${buildId}`)
                    .then(response => response.text())
                    .then(data => {
                        // Insert the modal content
                        modalBody.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error fetching build info:', error);
                    });
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('buildDetailsModal');
        const modalBody = modal.querySelector('.modal-body');

        // Listen for when the modal is triggered to open
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // The button that triggered the modal
            const buildId = button.getAttribute('data-build-id'); // Get the build ID from the button

            // Fetch the build details from the server
            fetch(`/builds/buildinfo/${buildId}`)
                .then(response => response.text())
                .then(data => {
                    // Insert the modal content
                    modalBody.innerHTML = data;

                    // After inserting the content, add event listener for Rate Now button
                    const rateNowBtn = modalBody.querySelector('#rateNowBtn');
                    const ratingForm = modalBody.querySelector('#ratingForm');

                    if (rateNowBtn) {
                        rateNowBtn.addEventListener('click', function() {
                            ratingForm.classList.toggle('d-none'); // Toggle visibility of the rating form
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching build info:', error);
                });
        });
    });
    </script>
@endsection
