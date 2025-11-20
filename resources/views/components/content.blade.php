@props(['class' => null])

<div class="content {{ $class }}">
    {!! $self->transform($slot) !!}
</div>
