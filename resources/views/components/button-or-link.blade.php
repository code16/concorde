

@if($attributes->get('href'))
    <a {{ $attributes }}>{{ $slot }}</a>
@else
    <button {{ $attributes }}>{{ $slot }}</button>
@endif
