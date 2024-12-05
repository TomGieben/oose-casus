<?php

namespace App\Exporters;

class Pdf extends Exporter
{
    public function download(): Exporter
    {
        // Download the resource as PDF
        return $this;
    }
}
