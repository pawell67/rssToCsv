<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

use PawelWankiewiczRekrutacjaHRtec\Resource\Rss\RssResourceFactory;
use PHPUnit\Framework\TestCase;

class CsvOutputTest extends TestCase
{
    protected $resourcesBundle;
    protected $csvOutput;
    protected $outputMessage;
    protected $factory;
    protected $csvOutputFactory;

    public function setUp(): void
    {
        $GLOBALS = [
            "OUTPUT_DIRECTORY" => "output/",
            "_SERVER" => ["SCRIPT_NAME" => "console.php"],
            "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"]
        ];
        $this->factory = new RssResourceFactory();
        $this->resourcesBundle = ["http://feeds.nationalgeographic.com/ng/News/News_Main", "file02.csv"];
        $this->csvOutput = $this->getMockForAbstractClass('\PawelWankiewiczRekrutacjaHRtec\Output\Csv\CsvOutput', [$this->resourcesBundle, $this->factory]);
        $this->outputMessage = sprintf("Data from %s was saved to %s%s", $this->resourcesBundle[0], $GLOBALS["OUTPUT_DIRECTORY"], $this->resourcesBundle[1]);
        $this->csvOutputFactory = new CsvOutputFactory();
    }

    public function testCanGetFileName(): void
    {
        $this->assertEquals("file02.csv", $this->csvOutput->getFileName());
    }

    public function testCreateOutputDirectory(): void
    {
        $this->assertDirectoryExists($GLOBALS["OUTPUT_DIRECTORY"]);
    }

    public function testIterateThroughData(): void
    {
        $this->setOutputCallback(function () {
        });
        $this->csvOutputFactory->createSimpleCsvOutput($this->resourcesBundle);
        $fileLinesCount = 102;
        $lineCount = 0;
        $file = fopen($GLOBALS["OUTPUT_DIRECTORY"] . $this->resourcesBundle[1], "r");

        while (!feof($file)) {
            fgets($file);
            $lineCount++;
        }

        $this->assertEquals($fileLinesCount, $lineCount);
    }
}