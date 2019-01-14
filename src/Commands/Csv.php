<?php

namespace PawelWankiewiczRekrutacjaHRtec\Commands;

use PawelWankiewiczRekrutacjaHRtec\Output\Csv\CsvOutput;
use PawelWankiewiczRekrutacjaHRtec\Output\Csv\CsvOutputFactory;

class Csv
{
    protected $resourcesBundle;
    protected $factory;
    protected $url;
    protected $file;
    protected $command;

    public function __construct(array $commandLineArguments)
    {
        if (!isset($commandLineArguments[2])) {
            $this->url = $GLOBALS["URL"];
        } else {
            $this->url = $this->checkUrlFormat($commandLineArguments[2]);
        }

        if (!isset($commandLineArguments[3])) {
            $this->file = $GLOBALS["OUTPUT_FILE_NAME"];
        } else {
            $this->checkFilePathFormat($commandLineArguments[3]);
        }

        $this->resourcesBundle = [$this->url, $this->file];
        $this->factory = new CsvOutputFactory();
        $this->checkCommandFormat($commandLineArguments[1]);
    }

    public function checkUrlFormat(string $url): string
    {
        if (substr($url, 0, 7) !== "http://" && substr($url, 0, 8) !== "https://") {
            die("Wrong URL format. URL should starts with `http://` or `https://`.");
        } else {
            return $url;
        }
    }

    public function checkFilePathFormat(string $file): string
    {
        if ($this->validateFilePath($file)) {
            $this->file = $file;
        } else {
            die("Wrong file path format. File path shouldn't contain \/?.\":*|<>");
        }

        if (pathinfo($this->file, PATHINFO_EXTENSION) !== "csv") {
            $this->file .= ".csv";
        }

        return $this->file;
    }

    public function checkCommandFormat(string $command): CsvOutput
    {
        if ($command === "csv:simple") {
            return $this->factory->createSimpleCsvOutput($this->resourcesBundle);
        } else if ($command === "csv:extended") {
            return $this->factory->createExtendedCsvOutput($this->resourcesBundle);
        } else {
            die("Please provide correct command. Type help for available commands.");
        }
    }

    public function validateFilePath($file): bool
    {
        return !preg_match('/[^A-Za-z0-9.#\\-$]/', $file);
    }
}