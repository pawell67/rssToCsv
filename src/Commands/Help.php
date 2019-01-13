<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

class Help
{
    public function __construct()
    {
        $this->showHelpMessage();
    }

    private function showHelpMessage():void
    {
        echo "\e[32mRssToCsv v0.1 \e[0m\n\n";
        echo "Usage: command [arguments]\n\n";
        echo "Available commands:\n\n";
        echo "\e[32mcsv:simple\e[0m [url] [filePath]      Simple csv output - overwrites the file\n";
        echo "\e[32mcsv:extended\e[0m [url] [filePath]    Extended csv output - if file exists extends file\n";
        echo "\e[32mhelp \e[0m                            Displays help message";
    }
}