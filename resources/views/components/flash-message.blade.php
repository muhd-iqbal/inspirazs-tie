@props(['type'])
@if (session($type))
    <div class="alert alert-{{ $type }} text-center" role="alert">
        {{ session($type) }}
    </div>
@endif
