@props(['enabled' => true])

{{-- max-width 772px = 65ch of 1.1875rem --}}
<div class="{{ $enabled ? 'w-full max-w-193 mx-auto' : 'contents' }}">
    {{ $slot }}
</div>
