@props(['status' => 'active'])

@php
    $colors = [
        'active' => 'success',
        'inactive' => 'danger',
        'pending' => 'warning',
        'draft' => 'secondary'
    ];
    
    $texts = [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'pending' => 'Pending',
        'draft' => 'Draft'
    ];
    
    $color = $colors[$status] ?? 'secondary';
    $text = $texts[$status] ?? ucfirst($status);
@endphp

<span class="badge bg-{{ $color }}">{{ $text }}</span>