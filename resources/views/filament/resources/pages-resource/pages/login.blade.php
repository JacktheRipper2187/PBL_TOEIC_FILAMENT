<x-filament-panels::page>
    <form method="POST" action="{{ route('filament.auth.login') }}">
        @csrf

        <x-filament::input.wrapper>
            <x-filament::input.text name="username" placeholder="Username" required autofocus />
        </x-filament::input.wrapper>

        <x-filament::input.wrapper class="mt-4">
            <x-filament::input.text name="password" type="password" placeholder="Password" required />
        </x-filament::input.wrapper>

        <div class="mt-4">
            <button type="submit" class="filament-button">
                Login
            </button>
        </div>
    </form>
</x-filament-panels::page>
