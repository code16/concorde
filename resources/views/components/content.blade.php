@props(['class' => ''])

<div class="content {{ $class }}">
    {!! $self->transform($slot) !!}
</div>
