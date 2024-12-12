<div class="dropdown d-inline">
    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="exportDropdown{{ $resource->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        {{ __('Export') }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="exportDropdown{{ $resource->id }}">
        @foreach ($exportTypes as $exportType)
            <li><a class="dropdown-item" href="{{ route('resources.export', ['resource' => $resource->id, 'type' => $exportType]) }}">{{ __('Export as :type', ['type' => strtoupper($exportType)]) }}</a></li>
        @endforeach
    </ul>
</div>