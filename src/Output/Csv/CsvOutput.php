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

    public function __construct(array $resourcesBundle, RssResourceFactory $resourceFactory)
    {
        $this->file = $resourcesBundle[1];
        $rssResource = $resourceFactory->create($resourcesBundle);
        $this->content = $rssResource->getContent();
        $this->url = $rssResource->getUrl();
        $this->createOutputDirectory();
        $this->fileFullPath = $GLOBALS["OUTPUT_DIRECTORY"] . $this->file;
        $this->saveToFile();
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

    public function iterateThroughData($fp):void
    {
        foreach ($this->content->channel->item as $entry) {
            $entry->description = strip_tags($entry->description);
            $entry->pubDate = date("j F Y g:i:s", strtotime($entry->pubDate));
            fputcsv($fp, [$entry->title, $entry->description, $entry->link, $entry->pubDate, $entry->creator]);
        }
        fclose($fp);
    }

    public function displayOutputMessage(): void
    {
        echo sprintf("Data from %s was saved to %s%s", $this->url, $GLOBALS["OUTPUT_DIRECTORY"], $this->file);
    }

    abstract public function saveToFile(): void;
}