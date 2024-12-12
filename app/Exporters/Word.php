<?php

namespace App\Exporters;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class Word extends Exporter
{
    public function download(): HttpResponse
    {
        $content = $this->resource->content;
        $headers = [
            'Content-Type' => 'application/vnd.ms-word',
            'Content-Disposition' => 'attachment; filename="' . $this->resource->name . '.doc"',
        ];

        return Response::make($content, 200, $headers);
    }
}
