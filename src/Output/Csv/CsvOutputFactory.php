<?php

namespace PawelWankiewiczRekrutacjaHRtec\Output\Csv;

use PawelWankiewiczRekrutacjaHRtec\Resource\Rss\RssResourceFactory;

class CsvOutputFactory
{
    protected $resourceFactory;

    public function __construct()
    {
        $this->resourceFactory = new RssResourceFactory();
    }

    public function createSimpleCsvOutput($commandLineArguments)
    {
        return new SimpleCsvOutput($commandLineArguments, $this->resourceFactory);
    }

    public function createExtendedCsvOutput($commandLineArguments)
    {
        return new ExtendedCsvOutput($commandLineArguments, $this->resourceFactory);
    }
}