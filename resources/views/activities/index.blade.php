<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteiten</title>
</head>
<body>
    <h1>Activiteiten</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('activities.create') }}">Nieuwe activiteit</a>

    <ul>
        @foreach($activities as $activity)
            <li style="margin-bottom: 1rem; border-left: 6px solid {{ $activity->color ?? '#2563eb' }}; padding-left: 0.75rem;">
                <strong>{{ $activity->title }}</strong><br>
                {{ $activity->date->format('d-m-Y') }} | {{ $activity->start_time }} - {{ $activity->end_time }}<br>
                {{ $activity->location ?? 'Geen locatie' }} | {{ $activity->target_group ?? 'Iedereen' }}<br>
                {{ $activity->description }}

                @can('edit activities')
                    <a href="{{ route('activities.edit', $activity) }}">Bewerken</a>
                @endcan

                @can('delete activities')
                    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>
</body>
</html>
