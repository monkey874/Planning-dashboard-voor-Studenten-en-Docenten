<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::with('roles')->get(),
            'roles' => ['docent', 'superbeheerder'],
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique(User::class)],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['docent', 'superbeheerder'])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        if ($validated['role'] === 'superbeheerder' && ! $user->hasRole('docent')) {
            $user->assignRole('docent');
        }

        return redirect()->route('users.index')->with('success', 'Gebruiker aangemaakt.');
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => ['required', 'array'],
            'roles.*' => ['required', Rule::in(['docent', 'superbeheerder'])],
        ]);

        $roles = $validated['roles'];

        if (in_array('superbeheerder', $roles, true) && ! in_array('docent', $roles, true)) {
            $roles[] = 'docent';
        }

        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Rollen bijgewerkt.');
    }
}
