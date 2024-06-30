<div class="absolute bottom-0 right-0 m-2 w-full min-w-[250px] max-w-[400px]">
    @if ($show)
        <div
        style="background-color: {{ $color}}"
            class="w-full  h-[100px] rounded-md p-2 text-secondary">
            {{ $message }}
        </div>
    @endif
</div>
