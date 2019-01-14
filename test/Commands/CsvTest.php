<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

use PawelWankiewiczRekrutacjaHRtec\Output\Csv\SimpleCsvOutput;
use PHPUnit\Framework\TestCase;

class CsvTest extends TestCase
{
    protected $command;
    protected $commandLineArguments;
    protected $url;

    public function setUp(): void
    {
        $GLOBALS = [
            "OUTPUT_FILE_NAME" => "file.csv",
            "URL" => "http://feeds.nationalgeographic.com/ng/News/News_Main",
            "OUTPUT_DIRECTORY" => "output/",
            "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"]
        ];
        $this->commandLineArguments = ["console.php", "csv:simple", "http://feeds.nationalgeographic.com/ng/News/News_Main", "file.csv"];
        $this->setOutputCallback(function () {
        });
        $this->command = new Csv($this->commandLineArguments);
    }

    public function testCheckUrlFormat(): void
    {
        $url = $this->command->checkUrlFormat($this->commandLineArguments[2]);
        $this->assertEquals($this->commandLineArguments[2], $url);
    }

    public function testCheckCommandFormat(): void
    {
        $command = $this->command->checkCommandFormat($this->commandLineArguments[1]);
        $this->assertInstanceOf(SimpleCsvOutput::class, $command);
    }

    public function testCheckFilePathFormat(): void
    {
        $filePath = $this->command->checkFilePathFormat($this->commandLineArguments[3]);
        $this->assertEquals($this->commandLineArguments[3], $filePath);
    }

    public function testCheckFilePathFormatIsWithoutCsvExtension(): void
    {
        $filePathWithoutExtension = "fileWithoutExtension";
        $filePath = $this->command->checkFilePathFormat($filePathWithoutExtension);
        $this->assertEquals($filePathWithoutExtension . ".csv", $filePath);
    }
}