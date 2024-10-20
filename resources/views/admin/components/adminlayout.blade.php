<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/aside.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- Include Bootstrap CSS in your layout file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Sidebar for navigation -->
<div class="dashboard-sidebar">
    <div class="logo-details">
      <div class="logo_name">Easy Builder PC</div>
      <i class='bx bx-menu' id="btn"></i> <!-- Menu button to toggle sidebar -->
    </div>
    <ul class="nav-list">
      @yield('sidebar')

      <!-- Profile section -->
      <li class="profile">
        <div class="profile-details">
          <div class="name_job">
            <div class="name">ADMIN</div>
            <div class="job">Admin</div>
          </div>
        </div>

        <!-- Logout form -->
        <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Logout icon with click event -->
        <i class='bx bx-log-out' id="log_out" onclick="document.getElementById('logoutForm').submit();"></i>
      </li>
    </ul>
</div>

<!-- Main content area -->
<section class="home-section">
    @yield('content')
</section>

<!-- Modal section -->
@yield('modal')

<!-- JavaScript to handle sidebar and modals -->
<script>
    // Sidebar toggle
    let sidebar = document.querySelector(".dashboard-sidebar");
    let closeBtn = document.querySelector("#btn");
    let navList = document.querySelector(".nav-list");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        navList.classList.toggle("scroll");
        menuBtnChange();
    });

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }

    document.getElementById('log_out').addEventListener('click', function (event) {
        event.preventDefault();
        if (confirm('Are you sure you want to log out?')) {
            document.getElementById('logoutForm').submit();
        }
    });
</script>

@yield('scripts')

</body>
</html>
