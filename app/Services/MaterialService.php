<?php

namespace App\Services;

use App\Exporters\Exporter;

class MaterialService
{
    public function downloadMaterial(): void
    {

    }

    private function validateFormat(): bool
    {
        return true;
    }

    private function downloadResource(Exporter $exporter): Exporter
    {
        return $exporter->download();
    }
}