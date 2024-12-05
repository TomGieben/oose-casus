<?php

namespace App\Exporters;

class Csv extends Exporter
{
    public function download(): Exporter
    {
        // Download the resource as CSV
        return $this;
    }
}
