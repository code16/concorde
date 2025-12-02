@props(['enabled' => true])

<div class="{{ $enabled ? 'text-[1.1875rem]/[1.875rem] w-[65ch] max-w-full mx-auto' : 'contents' }}">
    {{ $slot }}
</div>
