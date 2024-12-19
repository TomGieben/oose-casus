<?php

namespace App\Exporters;

use App\Exporters\Pdf\PdfBuilder;
use App\Exporters\Pdf\PdfDocumentConfig;
use App\Exporters\Pdf\TextFormatter;
use App\Models\Resource;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class Pdf extends Exporter
{
    private PdfBuilder $pdfBuilder;
    private TextFormatter $textFormatter;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;

        $this->pdfBuilder = new PdfBuilder();
        $this->textFormatter = new TextFormatter();
    }

    public function download(): HttpResponse
    {
        $config = new PdfDocumentConfig(
            linesPerPage: 28,
            lineWidth: 40,
            pageWidth: 612,
            pageHeight: 792
        );

        $lines = $this->textFormatter->splitTextIntoLines(
            $this->resource->content,
            $config->lineWidth
        );

        $pdfContent = $this->pdfBuilder
            ->setConfig($config)
            ->addPages($lines)
            ->build();

        return Response::make(
            $pdfContent,
            200,
            $this->getPdfHeaders($this->resource->name)
        );
    }

    private function getPdfHeaders(string $filename): array
    {
        return [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.pdf"',
        ];
    }
}
