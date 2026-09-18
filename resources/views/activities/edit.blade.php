<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteit bewerken</title>
</head>
<body>
    <h1>Activiteit bewerken</h1>

    <form method="POST" action="{{ route('activities.update', $activity) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Titel</label>
            <input type="text" name="title" value="{{ old('title', $activity->title) }}" required>
        </div>
        <div>
            <label>Datum</label>
            <input type="date" name="date" value="{{ old('date', $activity->date->format('Y-m-d')) }}" required>
        </div>
        <div>
            <label>Starttijd</label>
            <input type="time" name="start_time" value="{{ old('start_time', $activity->start_time) }}" required>
        </div>
        <div>
            <label>Eindtijd</label>
            <input type="time" name="end_time" value="{{ old('end_time', $activity->end_time) }}" required>
        </div>
        <div>
            <label>Omschrijving</label>
            <textarea name="description">{{ old('description', $activity->description) }}</textarea>
        </div>
        <div>
            <label>Locatie</label>
            <input type="text" name="location" value="{{ old('location', $activity->location) }}">
        </div>
        <div>
            <label>Doelgroep / klas</label>
            <input type="text" name="target_group" value="{{ old('target_group', $activity->target_group) }}">
        </div>
        <div>
            <label>Opleiding</label>
            <input type="text" name="program" value="{{ old('program', $activity->program) }}">
        </div>
        <div>
            <label>Kleur</label>
            <input type="color" name="color" value="{{ old('color', $activity->color ?? '#2563eb') }}">
        </div>

        <button type="submit">Opslaan</button>
        <a href="{{ route('activities.index') }}">Annuleren</a>
    </form>
</body>
</html>
