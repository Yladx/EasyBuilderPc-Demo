<!-- Modal for Adding Build -->
<div class="modal fade" id="addbuild" tabindex="-1" aria-labelledby="signModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">ADD BUILD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('builds.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="build_name">Build Name</label>
                        <input type="text" class="form-control" id="build_name" name="build_name" required>
                    </div>
                    <!-- Include other form fields for CPU, GPU, RAM, etc. -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Build</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
