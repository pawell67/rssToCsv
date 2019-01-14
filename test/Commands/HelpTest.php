<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

use PHPUnit\Framework\TestCase;

class HelpTest extends TestCase
{
    protected $command;
    protected $helpMessage;

    protected function setUp(): void
    {
        $this->setOutputCallback(function () {
        });
        $this->helpMessage = "\e[32mRssToCsv v0.1 \e[0m";
    }

    public function testShowHelpMessage(): void
    {
        $this->command = new Help;
        $this->assertContains("\e[32mRssToCsv v0.1 \e[0m", $this->helpMessage);
    }
}