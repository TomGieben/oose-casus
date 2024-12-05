<?php

namespace App\Exporters;

class Word extends Exporter
{
    public function download(): Exporter
    {
        // Download the resource as Word
        return $this;
    }
}
