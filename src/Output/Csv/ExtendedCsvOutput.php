<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

class ExtendedCsvOutput extends CsvOutput
{
    public function saveToFile(): void
    {
        $filePath = fopen($this->fileFullPath, 'a');
        if (filesize($this->fileFullPath) === 0) {
            fputcsv($filePath, $GLOBALS["COLUMNS_HEADERS"]);
        }

        $this->iterateThroughData($filePath);
    }
}