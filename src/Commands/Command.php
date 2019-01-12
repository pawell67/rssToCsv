<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

class Command
{
    public function __construct(array $commandLineArguments)
    {
        $this->checkArguments($commandLineArguments);
    }

    protected function checkArguments(array $commandLineArguments)
    {
        if (!isset($commandLineArguments[1]) || substr($commandLineArguments[1], 0, 10) === "help") {
            return new Help();
        } else if (substr($commandLineArguments[1], 0, 3) === "csv") {
            return new Csv($commandLineArguments);
        } else {
            die("Wrong command. Type help to see available commands.");
        }

    }

}