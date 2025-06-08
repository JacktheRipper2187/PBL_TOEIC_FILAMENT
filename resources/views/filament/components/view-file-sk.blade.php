@php
    $record = $getRecord(); // Built-in Filament helper
@endphp

@if ($record && $record->file_sk)
    <a href="{{ asset('storage/' . $record->file_sk) }}" target="_blank" class="text-blue-600 underline">
        📄 Lihat File SK
    </a>
@else
    <span class="text-gray-500">Belum digenerate</span>
@endif
