{{-- resources/views/admin/data/ActivityLog/UserInfo.blade.php --}}
<p><strong>ID:</strong> {{ $user->id }}</p>
<p><strong>Build Name:</strong> {{ $user->name }}</p>
<p><strong>First Name:</strong> {{ $user->fname }}</p>
<p><strong>Last Name:</strong> {{ $user->lname }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Password:</strong> {{ $user->password }}</p>
<p><strong>Email Verified At:</strong> {{ $user->email_verified_at ?? 'Not verified' }}</p>
<p><strong>Created At:</strong> {{ $user->created_at }}</p>
<p><strong>Updated At:</strong> {{ $user->updated_at }}</p>

{{-- Optionally display activity logs --}}
<h5>Activity Logs:</h5>
@if ($user->activityLogs->isEmpty())
    <p>No activity logs available for this user.</p>
@else
    <ul>
        @foreach ($user->activityLogs as $log)
            <li>{{ $log->activity }} at {{ $log->created_at }}</li>
        @endforeach
    </ul>
@endif
