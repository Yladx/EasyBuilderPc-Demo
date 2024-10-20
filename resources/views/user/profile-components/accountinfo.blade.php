
<div>
    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('profile.update') }}" method="POST">
    @csrf <!-- CSRF token for security -->

    <p>Your account information</p>

    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ auth()->user()->name }}">
        @error('username')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <!-- First Name -->
    <div>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" value="{{ auth()->user()->fname }}">
        @error('fname')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Last Name -->
    <div>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="{{ auth()->user()->lname }}">
        @error('lname')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}">
        @error('email')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>



    <div>
        <button type="submit">Update Profile</button>
    </div>
</form>


</div>
