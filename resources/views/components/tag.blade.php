@props([
    'class' => '',
    /** @var \App\Enums\TagColor $color **/
    'color',
])

<div class="px-2.5 py-0.5 text-xs/5.5 font-semibold rounded-lg {{ match($color) {
    \App\Enums\TagColor::Blue => 'bg-blue-100 text-blue-900',
    \App\Enums\TagColor::Green => 'bg-emerald-50 text-emerald-900',
    \App\Enums\TagColor::Orange => 'bg-orange-100 text-orange-800',
    \App\Enums\TagColor::Purple => 'bg-purple-100 text-purple-900',
    \App\Enums\TagColor::Fuchsia => 'bg-fuchsia-100 text-fuchsia-900',
    \App\Enums\TagColor::Yellow => 'bg-amber-100 text-amber-900',
    \App\Enums\TagColor::Cyan => 'bg-cyan-100 text-cyan-900',
    \App\Enums\TagColor::Gray => 'bg-slate-100 text-slate-700',
    \App\Enums\TagColor::Lime => 'bg-lime-100 text-lime-900',
    default => 'bg-eggplant text-white',
} }} {{ $class }}" {{ $attributes }}>
    {{ $slot }}
</div>
