<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

class ExtendedCsvOutput extends CsvOutput
{
    public function saveToFile(): void
    {
        $fp = fopen($this->fileFullPath, 'a');
        if (filesize($this->fileFullPath) === 0) {
            fputcsv($fp, $GLOBALS["COLUMNS_HEADERS"]);
        }

        $this->iterateThroughData($fp);
        $this->displayOutputMessage();
    }
}