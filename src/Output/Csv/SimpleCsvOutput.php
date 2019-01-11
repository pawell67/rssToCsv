<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

class SimpleCsvOutput extends CsvOutput
{
    public function saveToFile(): void
    {
        $fp = fopen($this->fileFullPath, 'w');

        fputcsv($fp, $GLOBALS["COLUMNS_HEADERS"]);

        $this->iterateThroughData($fp);
    }
}