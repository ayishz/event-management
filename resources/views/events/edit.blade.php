<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>

<h2>Edit Event</h2>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $event->title }}" placeholder="Event Title" required><br><br>

    <textarea name="description" placeholder="Description">{{ $event->description }}</textarea><br><br>

    <input type="date" name="event_date" value="{{ $event->event_date }}" required><br><br>

    <input type="text" name="location" value="{{ $event->location }}" placeholder="Location" required><br><br>

    <label>Current Image:</label><br>
    @if($event->image)
        <img src="{{ asset('storage/'.$event->image) }}" width="100"><br><br>
    @endif

    <label>Change Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update Event</button>
</form>

<br>
<a href="{{ route('events.index') }}">Back to Events</a>

</body>
</html>
