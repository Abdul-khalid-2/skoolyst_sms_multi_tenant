@props([
    'id',
    'title',
    'message',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmColor' => 'danger',
    'method' => 'POST'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ $message }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $cancelText }}</button>
                <form action="" method="{{ $method }}" id="modal-form-{{ $id }}">
                    @csrf
                    @if($method === 'DELETE')
                        @method('DELETE')
                    @endif
                    <button type="submit" class="btn btn-{{ $confirmColor }}">{{ $confirmText }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#{{ $id }}').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            $('#modal-form-{{ $id }}').attr('action', url);
        });
    });
</script>
@endpush