@props(['class' => ''])

<div class="content wrap-break-word {{ $class }}">
    {!! $self->transform($slot) !!}
</div>
