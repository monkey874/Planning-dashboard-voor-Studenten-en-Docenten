<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteit aanmaken</title>
</head>
<body>
    <h1>Activiteit aanmaken</h1>

    <form method="POST" action="{{ route('activities.store') }}">
        @csrf

        <div>
            <label>Titel</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Datum</label>
            <input type="date" name="date" required>
        </div>
        <div>
            <label>Starttijd</label>
            <input type="time" name="start_time" required>
        </div>
        <div>
            <label>Eindtijd</label>
            <input type="time" name="end_time" required>
        </div>
        <div>
            <label>Omschrijving</label>
            <textarea name="description"></textarea>
        </div>
        <div>
            <label>Locatie</label>
            <input type="text" name="location">
        </div>
        <div>
            <label>Doelgroep / klas</label>
            <input type="text" name="target_group">
        </div>
        <div>
            <label>Opleiding</label>
            <input type="text" name="program">
        </div>
        <div>
            <label>Kleur</label>
            <input type="color" name="color" value="#2563eb">
        </div>

        <button type="submit">Opslaan</button>
        <a href="{{ route('activities.index') }}">Annuleren</a>
    </form>
</body>
</html>
