<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
</head>
<body>

<h2>Create New Event</h2>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" placeholder="Event Title" required><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="date" name="event_date" required><br><br>

    <input type="text" name="location" placeholder="Location" required><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Create Event</button>
</form>

<br>
<a href="{{ route('events.index') }}">View All Events</a>

</body>
</html>
