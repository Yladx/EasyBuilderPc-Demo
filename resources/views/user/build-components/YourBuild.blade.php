@extends('components.layout')

@section('title', 'Your Builds')

<style>
    table {
        table-layout: fixed;
    }
    th, td {
        text-align: center;
        padding: 4px;
        width: 100px;
        font-size: 12px;
        max-width: 100px; /* Set max-width for each column */
        word-wrap: break-word; /* Prevent content from overflowing */
    }
    th {
        background-color: #e9d6d6;
    }
</style>

@section('content')
    @include('components.userheader')

    <div class="container">
        <h1>Your Builds</h1>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @foreach($userbuilds as $userbuild)
            <div class="mt-3 border border-dark p-2" style="background-color: grey;">
                <div class="row">
                    <div class="col-10">
                        <h3>{{ $userbuild->build_name }}</h3>
                        <p><strong>Description:</strong> {{ $userbuild->build_note }}</p>

                        <div class="container d-flex justify-content-center align-items-center">
                            <table>
                                <thead>
                                    <tr>
                                        <th>CPU</th>
                                        <th>GPU</th>
                                        <th>Motherboard</th>
                                        <th>RAM</th>
                                        <th>Storage</th>
                                        <th>Power Supply</th>
                                        <th>PC Case</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $userbuild->cpu->name ?? 'N/A' }}</td>
                                        <td>{{ $userbuild->gpu->name ?? 'N/A' }}</td>
                                        <td>{{ $userbuild->motherboard->name ?? 'N/A' }}</td>
                                        <td>{{ $userbuild->ram->name ?? 'N/A' }}</td>
                                        <td>{{ $userbuild->storage->name ?? 'N/A' }}</td>
                                        <td>{{ $userbuild->powerSupply->name ?? 'N/A' }}</td>
                                        <td>{{ $userbuild->pcCase->name ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-2 d-flex flex-column justify-content-around">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userbuildinfoModal" data-build-id="{{ $userbuild->id }}">View/Edit</a>

                        <form action="{{ route('build.delete', $userbuild->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal for build details -->
        <div class="modal fade" id="userbuildinfoModal" tabindex="-1" aria-labelledby="userbuildinfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userbuildinfoModalLabel">Build Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Build details will be dynamically loaded here -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('userbuildinfoModal'); // Updated ID
        const modalBody = modal.querySelector('.modal-body');
        const modalKey = 'buildModalOpen';
        const buildIdKey = 'selectedBuildId';

        // Check if the modal should be open when the page loads
        if (localStorage.getItem(modalKey) === 'open' && localStorage.getItem(buildIdKey)) {
            const buildId = localStorage.getItem(buildIdKey);
            fetchBuildDetails(buildId);
        }

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const buildId = button.getAttribute('data-build-id');
            fetchBuildDetails(buildId);

            localStorage.setItem(modalKey, 'open');
            localStorage.setItem(buildIdKey, buildId);
        });

        modal.addEventListener('hidden.bs.modal', function () {
            localStorage.setItem(modalKey, 'closed');
            localStorage.removeItem(buildIdKey);
        });

        function fetchBuildDetails(buildId) {
            fetch(`builds/userbuildinfo/${buildId}`)
                .then(response => response.text())
                .then(data => {
                    modalBody.innerHTML = data; // Insert the modal content
                    initializeEditFunctionality();
                })
                .catch(error => {
                    console.error('Error fetching build info:', error);
                });
        }

        function initializeEditFunctionality() {
            const editButton = modalBody.querySelector('#editButton');
            const saveButton = modalBody.querySelector('#saveButton');

            editButton.addEventListener('click', function() {
                const inputs = modalBody.querySelectorAll('input[readonly]');
                inputs.forEach(input => {
                    input.removeAttribute('readonly');
                });

                const checkboxes = modalBody.querySelectorAll('input[type="checkbox"][disabled]');
                checkboxes.forEach(checkbox => {
                    checkbox.removeAttribute('disabled');
                });

                const textareas = modalBody.querySelectorAll('textarea[readonly]');
                textareas.forEach(textarea => {
                    textarea.removeAttribute('readonly');
                });

                editButton.classList.add('d-none');
                saveButton.classList.remove('d-none');
            });

            updateForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                console.log('Form submitted'); // Debugging log


            });
        }

    });

</script>
