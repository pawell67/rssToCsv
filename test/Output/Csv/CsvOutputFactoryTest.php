<?php

use PawelWankiewiczRekrutacjaHRtec\Output\Csv\ExtendedCsvOutput;
use PawelWankiewiczRekrutacjaHRtec\Output\Csv\SimpleCsvOutput;
use PawelWankiewiczRekrutacjaHRtec\Output\Csv\CsvOutputFactory;
use PHPUnit\Framework\TestCase;

class CsvOutputFactoryTest extends TestCase
{
    protected $resourcesBundle;
    protected $csvFactory;
    protected $resource;

    public function setUp(): void
    {
        $GLOBALS = [
            "OUTPUT_FILE_NAME" => "file.csv",
            "URL" => "http://feeds.nationalgeographic.com/ng/News/News_Main",
            "OUTPUT_DIRECTORY" => "output/",
            "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"]
        ];
        $this->resourcesBundle = ["http://feeds.nationalgeographic.com/ng/News/News_Main", "file01.csv"];
        $this->csvFactory = new CsvOutputFactory();
        $this->setOutputCallback(function () {
        });
    }

    public function testCreateSimpleCsvOutput(): void
    {
        $outputClass = $this->csvFactory->createSimpleCsvOutput($this->resourcesBundle);
        $this->assertInstanceOf(SimpleCsvOutput::class, $outputClass);
    }

    public function testCreateExtendedCsvOutput(): void
    {
        $outputClass = $this->csvFactory->createExtendedCsvOutput($this->resourcesBundle);
        $this->assertInstanceOf(ExtendedCsvOutput::class, $outputClass);
    }
}