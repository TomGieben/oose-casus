<?php

namespace App\Exporters\Pdf;

final class PdfBuilder
{
    private array $pdfData = [];
    private PdfDocumentConfig $config;
    private TextFormatter $textFormatter;
    private int $objectNumber = 3;
    private array $pages = [];

    public function __construct()
    {
        $this->textFormatter = new TextFormatter();
    }

    public function setConfig(PdfDocumentConfig $config): self
    {
        $this->config = $config;
        return $this;
    }

    public function addPages(array $lines): self
    {
        $this->pages = array_chunk($lines, $this->config->linesPerPage);
        return $this;
    }

    public function build(): string
    {
        $this->pdfData = [
            $this->generateCatalog(),
            $this->generatePages(),
        ];

        foreach ($this->pages as $pageLines) {
            $this->pdfData[] = $this->defineFont();
            $this->pdfData[] = $this->generatePage($pageLines);
            $this->objectNumber += 3;
        }

        $xrefOffsets = $this->calculateXrefOffsets();
        $this->pdfData[] = $this->generateXref($xrefOffsets);
        $this->pdfData[] = $this->generateTrailer();

        return implode('', $this->pdfData);
    }

    private function generateCatalog(): string
    {
        return "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
    }

    private function generatePages(): string
    {
        $kids = [];
        $objNum = 3;

        for ($i = 0; $i < count($this->pages); $i++) {
            $kids[] = ($objNum + 1) . " 0 R";
            $objNum += 3;
        }

        return sprintf(
            "2 0 obj\n<< /Type /Pages /Count %d /Kids [%s] /MediaBox [0 0 %d %d] >>\nendobj\n",
            count($this->pages),
            implode(' ', $kids),
            $this->config->pageWidth,
            $this->config->pageHeight
        );
    }

    private function generatePage(array $lines): string
    {
        $pageObj = $this->objectNumber + 1;
        $contentObj = $this->objectNumber + 2;
        $yPosition = $this->config->startY;

        $textCommands = "BT\n/$pageObj {$this->config->lineHeight} Tf\n";

        foreach ($lines as $line) {
            $textCommands .= "1 0 0 1 {$this->config->startX} $yPosition Tm\n";
            $textCommands .= "(" . $this->textFormatter->escapeText($line) . ") Tj\n";
            $yPosition -= $this->config->lineHeight;
        }

        $textCommands .= "ET\n";
        $length = strlen($textCommands);

        return $this->formatPageObject($pageObj, $contentObj, $textCommands, $length);
    }

    private function defineFont(): string
    {
        return sprintf(
            "%d 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /%s >>\nendobj\n",
            $this->objectNumber,
            $this->config->font
        );
    }

    private function formatPageObject(int $pageObj, int $contentObj, string $textCommands, int $length): string
    {
        return sprintf(
            "%d 0 obj\n" .
                "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 %d %d] " .
                "/Resources << /Font << /%d %d 0 R >> >> /Contents %d 0 R >>\n" .
                "endobj\n" .
                "%d 0 obj\n" .
                "<< /Length %d >>\n" .
                "stream\n" .
                "%s" .
                "endstream\n" .
                "endobj\n",
            $pageObj,
            $this->config->pageWidth,
            $this->config->pageHeight,
            $pageObj,
            $this->objectNumber,
            $contentObj,
            $contentObj,
            $length,
            $textCommands
        );
    }

    private function calculateXrefOffsets(): array
    {
        $offset = 0;
        $offsets = [0];

        foreach ($this->pdfData as $data) {
            $offsets[] = $offset;
            $offset += strlen($data);
        }

        return $offsets;
    }

    private function generateXref(array $offsets): string
    {
        $xref = "xref\n";
        $xref .= "0 " . count($offsets) . "\n";

        foreach ($offsets as $offset) {
            $xref .= sprintf("%010d 00000 n \n", $offset);
        }

        return $xref;
    }

    private function generateTrailer(): string
    {
        return "trailer\n<< /Root 1 0 R >>\n%%EOF\n";
    }
}
