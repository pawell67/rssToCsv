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

    public function setUp(): void
    {
        $GLOBALS = [
            "OUTPUT_DIRECTORY" => "output/"
        ];
        $this->factory = new RssResourceFactory();
        $this->resourcesBundle = ["http://maxburstein.com/rss", "file01.csv"];
        $this->csvOutput = $this->getMockForAbstractClass('\PawelWankiewiczRekrutacjaHRtec\Output\Csv\CsvOutput', [$this->resourcesBundle, $this->factory]);
        $this->outputMessage = sprintf("Data from %s was saved to %s%s", $this->resourcesBundle[0], $GLOBALS["OUTPUT_DIRECTORY"], $this->resourcesBundle[1]);
    }

    public function testCanGetFileName(): void
    {
        $this->assertEquals("file01.csv", $this->csvOutput->getFileName());
    }

    public function testCreateOutputDirectory(): void
    {
        $this->assertDirectoryExists($GLOBALS["OUTPUT_DIRECTORY"]);
    }

    public function testDisplayOutputMessage(): void
    {
        $this->assertEquals("Data from http://maxburstein.com/rss was saved to output/file01.csv", $this->outputMessage);
    }

}