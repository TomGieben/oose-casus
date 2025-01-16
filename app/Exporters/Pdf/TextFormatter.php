<?php

namespace App\Exporters\Pdf;

final class TextFormatter
{
    public function splitTextIntoLines(string $text, int $maxCharsPerLine): array
    {
        $words = explode(' ', $text);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            if (strlen($currentLine) + strlen($word) + 1 <= $maxCharsPerLine) {
                $currentLine .= (empty($currentLine) ? '' : ' ') . $word;
                continue;
            }

            if (!empty($currentLine)) {
                $lines[] = $currentLine;
            }

            if (strlen($word) > $maxCharsPerLine) {
                $lines = array_merge($lines, str_split($word, $maxCharsPerLine));
                $currentLine = '';
            } else {
                $currentLine = $word;
            }
        }

        if (!empty($currentLine)) {
            $lines[] = $currentLine;
        }

        return $lines;
    }

    public function escapeText(string $text): string
    {
        return str_replace(
            ['\\', '(', ')'],
            ['\\\\', '\\(', '\\)'],
            $text
        );
    }
}
