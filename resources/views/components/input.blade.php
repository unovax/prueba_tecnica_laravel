@props(['disabled' => false, 'label' => ''])

<div class="space-y-1">
    <label>
        {{ $label }}
        <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'input']) !!}>
    </label>
</div>
