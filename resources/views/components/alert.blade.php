@props(['type' => 'info', 'message' => ''])

@php
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'warning' => 'yellow',
        'info' => 'blue',
    ];
@endphp

<div class="bg-{{ $colors[$type] }}-100 border border-{{ $colors[$type] }}-400 text-{{ $colors[$type] }}-700 px-4 py-3 rounded relative mb-4">
    <strong class="font-bold capitalize">{{ $type }}!</strong>
    <span class="block sm:inline">{{ $message }}</span>
</div>
