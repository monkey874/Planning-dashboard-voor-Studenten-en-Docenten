<x-layouts::app :title="__('Account registreren')">
    <div class="mx-auto flex w-full max-w-2xl flex-col gap-6">
        <div>
            <flux:heading size="xl">Account registreren</flux:heading>
            <flux:text class="mt-2">Maak een nieuw docent- of superbeheerderaccount aan.</flux:text>
        </div>

        <form method="POST" action="{{ route('users.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="name"
                label="Naam"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
            />

            <flux:input
                name="email"
                label="E-mailadres"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
            />

            <flux:input
                name="password"
                label="Wachtwoord"
                type="password"
                required
                autocomplete="new-password"
                viewable
            />

            <flux:select name="role" label="Rol" required>
                <option value="">Kies een rol</option>
                <option value="docent" @selected(old('role') === 'docent')>Docent</option>
                <option value="superbeheerder" @selected(old('role') === 'superbeheerder')>Superbeheerder</option>
            </flux:select>

            @if($errors->any())
                <div class="text-sm text-red-600 dark:text-red-400">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-center justify-end gap-3">
                <flux:button :href="route('users.index')" variant="ghost" wire:navigate>
                    Annuleren
                </flux:button>
                <flux:button type="submit" variant="primary">
                    Account aanmaken
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
