<?php

namespace App\Exporters;

use App\Models\Resource;

abstract class Exporter
{
    private Resource $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    abstract public function download(): Exporter;
}