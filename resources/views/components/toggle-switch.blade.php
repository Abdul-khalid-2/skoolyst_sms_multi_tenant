@props([
    'id' => null,
    'name',
    'checked' => false,
    'value' => '1',
    'offValue' => '0',
    'label' => null,
    'size' => 'md' // sm, md, lg
])

@php
    $id = $id ?? $name;
    $sizes = [
        'sm' => 'switch-sm',
        'md' => '',
        'lg' => 'switch-lg'
    ];
    $sizeClass = $sizes[$size] ?? '';
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $id }}" class="mr-3">{{ $label }}</label>
    @endif
    <div class="custom-control custom-switch custom-switch-{{ $size }} d-inline-block">
        <input type="checkbox" 
               class="custom-control-input" 
               id="{{ $id }}" 
               name="{{ $name }}"
               value="{{ $value }}"
               {{ $checked ? 'checked' : '' }}>
        <label class="custom-control-label" for="{{ $id }}"></label>
    </div>
    <input type="hidden" name="{{ $name }}" value="{{ $offValue }}">
</div>