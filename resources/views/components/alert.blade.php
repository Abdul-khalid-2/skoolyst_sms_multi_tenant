@props(['type' => 'success', 'message' => '', 'dismissible' => true])

@if($message)
    <div class="alert alert-{{ $type }} {{ $dismissible ? 'alert-dismissible' : '' }} fade show" role="alert">
        {{ $message }}
        @if($dismissible)
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        @endif
    </div>
@endif