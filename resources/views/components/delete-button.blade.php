<button type="button" class="btn btn-danger  @if($small) btn-sm m-0 @endif" onclick="showConfirmationModal('{{ $route }}')">
    <i class="fas fa-trash"></i> @if(!$small) {{ __('Delete') }} @endif
</button>
@push('footer-scripts')
    <form method="POST" id="{{ $route }}-delete" action="{{ $route }}">
        @csrf
        @method('DELETE')
    </form>
    <script>
        function showConfirmationModal(route) {
            if (confirm("{{ __('Are you sure you want to delete this data?') }}\n{{ __('This action cannot be undone.') }}")) {
                const form = document.getElementById(route + '-delete');
                form.submit();
            }
        }
    </script>
@endpush