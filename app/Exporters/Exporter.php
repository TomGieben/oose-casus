<?php

namespace App\Exporters;

use App\Models\Resource;
use Illuminate\Http\Response as HttpResponse;

abstract class Exporter
{
    protected Resource $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    abstract public function download(): HttpResponse;
}