<?php

namespace App\View\Components;

use App\Exporters\Csv;
use App\Exporters\Exporter;
use App\Exporters\Pdf;
use App\Exporters\Word;
use App\Models\Resource;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExporterDropdown extends Component
{
    private Resource $resource;
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function render(): View|Closure|string
    {
        return view('components.exporter-dropdown', [
            'resource' => $this->resource,
            'exportTypes' => $this->getExportTypes(),
        ]);
    }

    private function getExportTypes(): array
    {
        $files = scandir(app_path('Exporters'));
        $exportTypes = [];

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $exportType = pathinfo($file, PATHINFO_FILENAME);

            $class = 'App\\Exporters\\' . $exportType;
            if (!class_exists($class) || $class == Exporter::class) {
                continue;
            }

            $exportTypes[] = $exportType;
        }

        return $exportTypes;
    }
}
