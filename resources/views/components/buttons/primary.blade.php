@props(['text'])

<button {{ $attributes->merge([
    'class' => 'px-4 py-2 rounded-md bg-primary hover:bg-primary-hover text-secondary',
    'type' => 'button',
]) }}>{{ $text }}</button>
