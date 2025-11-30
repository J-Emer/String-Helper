<?php

namespace Jemer\StringHelper;

class Table
{
    private array $headers = [];
    private array $rows = [];
    private int $padding = 1;
    private ?int $maxColumnWidth = 40; 

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function addRow(array $row): void
    {
        $this->rows[] = $row;
    }

    /**
     * Optional: Force a maximum width for all columns (before wrapping)
     */
    public function setMaxColumnWidth(int $width): void
    {
        $this->maxColumnWidth = $width;
    }

    /**
     * Determine column widths BEFORE wrapping text.
     */
    private function getColumnWidths(): array
    {
        $widths = [];

        foreach ($this->headers as $i => $header) {
            $widths[$i] = mb_strlen($header);
        }

        foreach ($this->rows as $row) {
            foreach ($row as $i => $cell) {
                $len = mb_strlen((string)$cell);
                if (!isset($widths[$i]) || $len > $widths[$i]) {
                    $widths[$i] = $len;
                }
            }
        }

        // Apply max column width if set
        if ($this->maxColumnWidth !== null) {
            foreach ($widths as $i => $w) {
                if ($w > $this->maxColumnWidth) {
                    $widths[$i] = $this->maxColumnWidth;
                }
            }
        }

        return $widths;
    }

    /**
     * Word-wrap a single cell based on column width
     */
    private function wrapCell(string $text, int $width): array
    {
        // Use wordwrap to split into multiple lines
        $wrapped = wordwrap($text, $width, "\n", true);

        return explode("\n", $wrapped);
    }

    /**
     * Center text inside a given width
     */
    private function centerCell(string $text, int $width): string
    {
        $len = mb_strlen($text);
        $space = $width - $len;
        $left = intdiv($space, 2);
        $right = $space - $left;

        return str_repeat(" ", $left) . $text . str_repeat(" ", $right);
    }

    private function renderSeparator(array $widths): string
    {
        $line = "+";
        foreach ($widths as $width) {
            $line .= str_repeat("-", $width + ($this->padding * 2)) . "+";
        }
        return $line . PHP_EOL;
    }

    /**
     * Render a single row (may span multiple lines due to wrapping)
     */
    private function renderRow(array $row, array $widths): string
    {
        // Wrap each cell into multiple lines
        $wrappedCells = [];
        $maxLines = 1;

        foreach ($widths as $i => $width) {
            $cellText = $row[$i] ?? "";
            $wrapped = $this->wrapCell((string)$cellText, $width);
            $wrappedCells[$i] = $wrapped;

            if (count($wrapped) > $maxLines) {
                $maxLines = count($wrapped);
            }
        }

        $output = "";

        // Render each line of the wrapped row
        for ($lineIndex = 0; $lineIndex < $maxLines; $lineIndex++) {
            $output .= "|";

            foreach ($widths as $i => $width) {
                $text = $wrappedCells[$i][$lineIndex] ?? ""; // blank if shorter
                $text = $this->centerCell($text, $width);

                $output .= str_repeat(" ", $this->padding)
                        . $text
                        . str_repeat(" ", $this->padding)
                        . "|";
            }

            $output .= PHP_EOL;
        }

        return $output;
    }

    public function render(): string
    {
        $widths = $this->getColumnWidths();
        $out = "";

        $out .= $this->renderSeparator($widths);
        $out .= $this->renderRow($this->headers, $widths);
        $out .= $this->renderSeparator($widths);

        foreach ($this->rows as $row) {
            $out .= $this->renderRow($row, $widths);
        }

        $out .= $this->renderSeparator($widths);

        return $out;
    }
}
