<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikers</title>
</head>
<body>
    <h1>Gebruikers</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Rollen</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->join(', ') ?: 'geen rol' }}</td>
                    <td>
                        <form action="{{ route('users.updateRole', $user) }}" method="POST">
                            @csrf
                            @foreach($roles as $role)
                                <label style="display:block; margin-bottom:4px;">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" {{ $user->hasRole($role) ? 'checked' : '' }}>
                                    {{ $role }}
                                </label>
                            @endforeach
                            <button type="submit">Opslaan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
