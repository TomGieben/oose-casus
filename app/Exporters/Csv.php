<?php

namespace App\Exporters;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class Csv extends Exporter
{
    public function download(): HttpResponse
    {
        $content = $this->resource->content;
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $this->resource->name . '.csv"',
        ];

        return Response::make($content, 200, $headers);
    }
}
