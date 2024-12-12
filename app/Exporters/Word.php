<?php

namespace App\Exporters;

use Illuminate\Support\Facades\Response;

class Word extends Exporter
{
    public function download()
    {
        $content = $this->resource->content;
        $headers = [
            'Content-Type' => 'application/vnd.ms-word',
            'Content-Disposition' => 'attachment; filename="' . $this->resource->name . '.doc"',
        ];

        return Response::make($content, 200, $headers);
    }
}
