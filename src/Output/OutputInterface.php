<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output;

interface OutputInterface
{
    public function saveToFile(): void;

    public function checkFilePathFormat(array $commandLineArguments): void;
}
