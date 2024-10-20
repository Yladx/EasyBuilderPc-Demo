<!-- Login/SignUp Modal -->
<div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="signModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Login/Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you have an account?</p>
                <a href="{{ route('login') }}" class="btn btn-success mb-2 mx-1">Yes</a>
                <a href="{{ route('register') }}" class="btn btn-danger mb-2 mx-1">No</a>
            </div>
        </div>
    </div>
</div>
