<div class="p-4 border rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-2">Status Pendaftaran</h3>

    <p class="mb-2">
        Saat ini:
        <span class="{{ $status ? 'text-green-600' : 'text-red-600' }}">
            {{ $status ? 'Dibuka' : 'Ditutup' }}
        </span>
        {!! $override === null
            ? '<span class="text-gray-500">(Otomatis)</span>'
            : '<span class="text-yellow-600"></span>' !!}
        {{-- </span>
        {!! $override === null
            ? '<span class="text-gray-500">(Otomatis)</span>'
            : '<span class="text-yellow-600">(Manual Override)</span>' !!} --}}
    </p>

    <div class="flex flex-col sm:flex-row gap-2">
        <!-- Buka Manual -->
        <form wire:submit.prevent="setManualStatus(true)">
            <x-filament::button type="submit" color="success">
                Buka Pendaftaran
            </x-filament::button>
        </form>

        <!-- Tutup Manual -->
        <form wire:submit.prevent="setManualStatus(false)">
            <x-filament::button type="submit" color="danger">
                Tutup Pendaftaran
            </x-filament::button>
        </form>

        <!-- Kembali ke Otomatis -->
        <form wire:submit.prevent="setToAutomatic">
            <x-filament::button type="submit" color="gray">
                Mode Otomatis
            </x-filament::button>
        </form>
    </div>
</div>
