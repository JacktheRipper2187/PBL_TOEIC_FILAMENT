<x-filament::widget>
    <x-filament::card>
        <div class="space-y-4" wire:poll.5s>
            <h2 class="text-lg font-bold">Status Pendaftaran</h2>

            <div class="space-y-2">
                <label for="jadwal">Pilih Jadwal:</label>
                <select wire:model="selectedJadwalId" class="w-full border rounded p-2">
                    @foreach ($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}">
                            {{ $jadwal->nama_jadwal }} ({{ $jadwal->skema }})
                            @if ($jadwal->skema == 'gratis')
                                - {{ $jadwal->isActive() ? 'AKTIF' : 'NON-AKTIF' }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="p-4 border rounded-lg bg-gray-50">
                <p class="font-medium">Status Saat Ini:</p>
                <p class="text-lg {{ $this->status ? 'text-green-600' : 'text-red-600' }}">
                    {{ $this->status ? 'DIBUKA' : 'DITUTUP' }}
                    <span class="text-sm {{ $this->override === null ? 'text-blue-600' : 'text-yellow-600' }}">
                        ({{ $this->override === null ? 'OTOMATIS' : 'MANUAL' }})
                    </span>
                </p>

                @if ($this->override === null && $this->getCurrentJadwal())
                    <p class="text-sm mt-2">
                        Periode:
                        {{ \Carbon\Carbon::parse($this->getCurrentJadwal()->tgl_buka)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($this->getCurrentJadwal()->tgl_tutup)->format('d M Y') }}
                    </p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-filament::button color="success" wire:click="setManualStatus(true)" :disabled="$this->override === true">
                    Buka Manual
                </x-filament::button>

                <x-filament::button color="danger" wire:click="setManualStatus(false)" :disabled="$this->override === false">
                    Tutup Manual
                </x-filament::button>

                <x-filament::button color="primary" wire:click="setToAutomatic" :disabled="$this->override === null">
                    Mode Otomatis
                </x-filament::button>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
