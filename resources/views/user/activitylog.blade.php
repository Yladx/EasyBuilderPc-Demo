<div>
    <!-- Table to display activity logs -->
    @if($activities->isEmpty())
        <p>No activity found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->activity_timestamp }}</td>
                        <td>{{ $activity->activity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
