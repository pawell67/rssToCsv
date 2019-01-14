<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    protected $correctCommandLineArguments;
    protected $wrongCommandLineArguments;
    protected $helpCommandLineArguments;
    protected $correctCommand;
    protected $wrongCommand;
    protected $helpCommand;

    protected function setUp(): void
    {
        $GLOBALS = [
            "OUTPUT_DIRECTORY" => "output/",
            "_SERVER" => ["SCRIPT_NAME" => "console.php"],
            "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"]
        ];
        $this->wrongCommandLineArguments = ["css", "maxburstein.com", "file"];
        $this->correctCommandLineArguments = ["src/console.php", "csv:simple", "http://feeds.nationalgeographic.com/ng/News/News_Main", "file.csv"];
        $this->helpCommandLineArguments = ["help"];
    }

    public function testWrongCommand(): void
    {
        $this->wrongCommand = new Command($this->wrongCommandLineArguments);
        $output = "Wrong command. Type help to see available commands.";
        $this->expectOutputString($output);
    }

    public function testHelpCommand(): void
    {
        $this->setOutputCallback(function () {
        });
        $helpCommand = new Command($this->helpCommandLineArguments);
        $this->helpCommand = $helpCommand->checkArguments($this->helpCommandLineArguments);
        $this->assertInstanceOf(Help::class, $this->helpCommand);
    }

    public function testCorrectCommand(): void
    {
        $this->setOutputCallback(function () {
        });
        $outputDirectory = "output/";
        $this->correctCommand = new Command($this->correctCommandLineArguments);
        $this->correctCommand->checkArguments($this->correctCommandLineArguments);
        $this->assertFileExists($outputDirectory . $this->correctCommandLineArguments[3]);
    }
}