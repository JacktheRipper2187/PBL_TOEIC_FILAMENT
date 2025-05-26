<x-filament::page>
    {{ $this->form }}
    <x-filament::button wire:click="submit" type="submit" class="mt-4">
        Update Profile
    </x-filament::button>
</x-filament::page>