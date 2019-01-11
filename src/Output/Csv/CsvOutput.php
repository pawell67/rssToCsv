<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

use PawelWankiewiczRekrutacjaHRtec\Output\OutputInterface;
use PawelWankiewiczRekrutacjaHRtec\Resource\Rss\RssResourceFactory;

abstract class CsvOutput implements OutputInterface
{
    protected $file;
    protected $content;
    protected $url;
    protected $fileFullPath;

    public function __construct(array $commandLineArguments, RssResourceFactory $resourceFactory)
    {
        $this->checkFilePathFormat($commandLineArguments);
        $rssResource = $resourceFactory->create($commandLineArguments);
        $this->content = $rssResource->getContent();
        $this->url = $rssResource->getUrl();
        $this->createOutputDirectory();
        $this->fileFullPath = $GLOBALS["OUTPUT_DIRECTORY"] . $this->file;
    }

    public function checkFilePathFormat(array $commandLineArguments): void
    {
        if (!isset($commandLineArguments[2])) {
            $this->file = $GLOBALS["OUTPUT_FILE_NAME"];
        } else if (!$this->validateFilePath()) {
            die("Wrong file path format. File path shouldn't contain \/?.\":*|<>");
        } else {
            $this->file = $commandLineArguments[2];
        }

        if (pathinfo($this->file, 4) !== "csv") {
            $this->file .= ".csv";
        }
    }

    public function validateFilePath(): bool
    {
        return !preg_match('/[^A-Za-z0-9.#\\-$]/', $this->file);
    }

    public function getFileName(): string
    {
        return $this->file;
    }

    public function createOutputDirectory(): void
    {
        $outputDirectory = $GLOBALS["OUTPUT_DIRECTORY"];
        if (!file_exists($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
        }
    }

    public function iterateThroughData($fp)
    {
        foreach ($this->content->channel->item as $entry) {
            $entry->description = strip_tags($entry->description);
            $entry->pubDate = date("j F Y g:i:s", strtotime($entry->pubDate));
            fputcsv($fp, [$entry->title, $entry->description, $entry->link, $entry->pubDate, $entry->creator]);
        }
        fclose($fp);
    }

    abstract public function saveToFile(): void;
}