<?php

namespace App\Exporters;

use Illuminate\Support\Facades\Response;

class Pdf extends Exporter
{
    public function download()
    {
        $pdfContent = $this->generatePdfContent($this->resource->content);
        $headers = $this->getPdfHeaders($this->resource->name);

        return Response::make($pdfContent, 200, $headers);
    }

    private function generatePdfContent($content)
    {
        return "
        %PDF-1.4
        1 0 obj
        << /Type /Catalog /Pages 2 0 R >>
        endobj
        2 0 obj
        << /Type /Pages /Count 1 /Kids [3 0 R] >>
        endobj
        3 0 obj
        << /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R >>
        endobj
        4 0 obj
        << /Length 44 >>
        stream
        BT
        /F1 24 Tf
        100 700 Td
        (" . $content . ") Tj
        ET
        endstream
        endobj
        5 0 obj
        << /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>
        endobj
        xref
        0 6
        0000000000 65535 f
        0000000010 00000 n
        0000000074 00000 n
        0000000124 00000 n
        0000000207 00000 n
        0000000385 00000 n
        trailer
        << /Size 6 /Root 1 0 R >>
        startxref
        469
        %%EOF
        ";
    }

    private function getPdfHeaders($filename)
    {
        return [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.pdf"',
        ];
    }
}
