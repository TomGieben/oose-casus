<?php

namespace App\Exporters;

use Illuminate\Support\Facades\Response;

class Csv extends Exporter
{
    public function download()
    {
        $content = $this->resource->content;
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $this->resource->name . '.csv"',
        ];

        return Response::make($content, 200, $headers);
    }
}
