<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

class Command
{
    public function __construct(array $commandLineArguments)
    {
        $this->checkArguments($commandLineArguments);
    }

    public function checkArguments(array $commandLineArguments)
    {
        if (!isset($commandLineArguments[1]) || $commandLineArguments[1] === "help") {
            return new Help();
        } else if (substr($commandLineArguments[1], 0, 3) === "csv") {
            return new Csv($commandLineArguments);
        } else {
            $message = "Wrong command. Type help to see available commands.";
            echo $message;
        }
    }
}