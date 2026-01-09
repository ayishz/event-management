<!DOCTYPE html>
<html>
<head>
    <title>Event List</title>
</head>
<body>

<h2>All Events</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<a href="{{ route('events.create') }}">➕ Add New Event</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Location</th>
        <th>Actions</th> <!-- New column -->
    </tr>

    @forelse($events as $event)
        <tr>
            <td>
                @if($event->image)
                    <img src="{{ asset('storage/'.$event->image) }}" width="100">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $event->title }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ $event->event_date }}</td>
            <td>{{ $event->location }}</td>
            <td>
                <!-- Edit button -->
                <a href="{{ route('events.edit', $event->id) }}">✏️ Edit</a>

                <!-- Delete button -->
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this event?')">❌ Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No events found</td>
        </tr>
    @endforelse
</table>

</body>
</html>
