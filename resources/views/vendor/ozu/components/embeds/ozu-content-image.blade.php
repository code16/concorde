@props(['project' => null])

@php
/**
 * @var \Code16\OzuClient\Eloquent\Media $media
 */
@endphp


<div class="mb-14 md:mb-18 -mx-7.5 md:mx-0 flex justify-center">
    <figure class="contents md:block rounded-2xl p-2 bg-neutral-50 inset-ring inset-ring-neutral-200">
        <img class="max-w-full object-cover max-h-100 lg:max-h-128 border md:rounded-xl overflow-hidden border-neutral-200" src="{{ $media->thumbnail(1400) }}" alt="{{ $legend ?? '' }}">
        {{--            <img class="w-full" src="{{ asset('/img/as-home-cropped-sq.png') }}"--}}
        {{--                alt="{{ $legend ?? '' }}"--}}
        {{--                x-init="$el.animate({ translate:['0 0%', '0 calc(-100% + 100cqh)'] }, {--}}
        {{--                timeline: new ViewTimeline({ subject: $el.parentElement }),--}}
        {{--                fill: 'both',--}}
        {{--                rangeStart: 'entry 50%',--}}
        {{--                rangeEnd: 'exit 50%',--}}
        {{--            })"--}}

        @if($legend)
            <figcaption class="text-sm text-neutral-600 mt-3 mb-2 px-4">
                {{ $legend }}
            </figcaption>
        @endif
    </figure>
</div>

