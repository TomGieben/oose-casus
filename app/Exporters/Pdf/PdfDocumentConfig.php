<?php

namespace App\Exporters\Pdf;

final class PdfDocumentConfig
{
    public function __construct(
        public readonly int $linesPerPage,
        public readonly int $lineWidth,
        public readonly int $pageWidth,
        public readonly int $pageHeight,
        public readonly int $lineHeight = 24,
        public readonly int $startY = 700,
        public readonly int $startX = 100,
        public readonly string $font = 'Helvetica'
    ) {}
}
