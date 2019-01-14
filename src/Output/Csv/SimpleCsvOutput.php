<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

class SimpleCsvOutput extends CsvOutput
{
    public function saveToFile(): void
    {
        $filePath = fopen($this->fileFullPath, 'w');
        fputcsv($filePath, $GLOBALS["COLUMNS_HEADERS"]);

        $this->iterateThroughData($filePath);
    }
}