
<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-6 filament-button-size-sm flex items-center gap-2">
            <span class="inline-block w-5 h-5" aria-hidden="true">
                <!-- SVG: User + Pencil (Edit) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232a3 3 0 11-4.264 4.264 3 3 0 014.264-4.264z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25v-1.5A2.25 2.25 0 016.75 16.5h2.5m2.25 0h2.5a2.25 2.25 0 012.25 2.25v1.5M16.5 16.5l2.25-2.25m0 0l2.25 2.25m-2.25-2.25V21" />
                </svg>
            </span>
            Update Profile
        </x-filament::button>
    </form>
</x-filament::page>
