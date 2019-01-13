<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    protected $wrongCommandLineArguments;
    protected $wrongCommand;

    public function setUp()
    {
        $this->wrongCommandLineArguments = ["css", "maxburstein.com", "file"];
        $this->correctCommandLineArguments = ["csv:simple", "http://maxburstein.com/rss", "file.csv"];
    }

    public function testWrongCommand()
    {
        $this->wrongCommand = new Command($this->wrongCommandLineArguments);
        $output = "Wrong command. Type help to see available commands.";
        $this->expectOutputString($output);
    }
}