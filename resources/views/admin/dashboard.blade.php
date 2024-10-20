{{-- Admin Dashboard Layout --}}
@extends('admin.components.adminlayout')

@section('title', 'Admin Dashboard')

{{-- Sidebar section --}}
@section('sidebar')
<li>
    <a href="#" id="manageBuildBtn">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Manage PC Build</span>
    </a>
    <span class="tooltip">Manage Build</span>
</li>
<li>
    <a href="#" id="activityLogBtn">
        <i class='bx bx-user'></i>
        <span class="links_name">Activity Log</span>
    </a>
    <span class="tooltip">Activity Log</span>
</li>
<li>
    <a href="#" id="managePartsBtn">
        <i class='bx bx-pie-chart-alt-2'></i>
        <span class="links_name">PC PARTS</span>
    </a>
    <span class="tooltip">PC PARTS</span>
</li>

@endsection

{{-- Main content section --}}
@section('content')
<div class="container " id="manageBuild">
    <div class="text">Manage Build</div>
    <div class="row">
        <div class="col-md-8 col-xs-12" style="background-color: yellow;">
            <div class="row">
                @include('admin.data.Build.adminbuild')
            </div>
            <div class="row">
                @include('admin.data.Build.userBuild')
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="row">
                <!-- Include Build Count -->
                @include('admin.data.Build.buildcount')
            </div>
        </div>
    </div>
</div>

<div class="container d-none" id="activityLog">
    <div class="text">Activity Log</div>
    <div class="row">
        <div class="col-md-8 col-xs-12" style="background-color: yellow;">
            <div class="row p-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6" style="background-color: red">/</div>
                        <div class="col-6" style="background-color: rgb(102, 84, 84)">/</div>
                    </div>
                    <div class="container-fluid">
                        @include('admin.data.ActivityLog.UserLog')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-12" style="background-color: red; height: 500px">
            @include('admin.data.ActivityLog.RecentLog')
        </div>
    </div>
</div>



<div class="container" id="managePart">
    <div class="text">PC PARTS</div>
    @include('admin.data.PcParts.partList')

</div>

@endsection




@section('modal')

@include('admin.data.Build.buildrecModal')

@include('admin.data.ActivityLog.userinfomodal')
@endsection



{{-- Scripts Section --}}
@section('scripts')
<script>


    document.addEventListener('DOMContentLoaded', function () {
        // Get references to all sections
        const manageBuildSection = document.getElementById('manageBuild');
        const activityLogSection = document.getElementById('activityLog');
        const managePartSection = document.getElementById('managePart');

        // Get references to all sidebar buttons
        const manageBuildBtn = document.getElementById('manageBuildBtn');
        const activityLogBtn = document.getElementById('activityLogBtn');
        const managePartsBtn = document.getElementById('managePartsBtn');

        // Function to hide all sections
        function hideAllSections() {
            manageBuildSection.classList.add('d-none');
            activityLogSection.classList.add('d-none');
            managePartSection.classList.add('d-none');
        }

        // Function to show a specific section and save to localStorage
        function showSection(sectionId) {
            hideAllSections(); // Hide other sections
            const section = document.getElementById(sectionId);
            if (section) {
                section.classList.remove('d-none'); // Show the specified section
                localStorage.setItem('activeSection', sectionId); // Save current section in localStorage
            }
        }

        // Event Listeners for Sidebar Buttons
        manageBuildBtn.addEventListener('click', function () {
            showSection('manageBuild'); // Show Manage Build
        });

        activityLogBtn.addEventListener('click', function () {
            showSection('activityLog'); // Show Activity Log
        });

        managePartsBtn.addEventListener('click', function () {
            showSection('managePart'); // Show Manage PC Parts
        });

        // On page load, check localStorage and load the saved section
        const savedSection = localStorage.getItem('activeSection');
        if (savedSection) {
            showSection(savedSection); // Load the last active section
        } else {
            showSection('manageBuild'); // Default to Manage Build section if nothing is saved
        }
    });
</script>

@endsection
