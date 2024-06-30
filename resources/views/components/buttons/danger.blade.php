@props(['text'])

<button {{ $attributes->merge([
    'class' => 'px-4 py-2 rounded-md bg-danger hover:bg-danger-hover text-secondary',
    'type' => 'button',
]) }}>{{ $text }}</button>
