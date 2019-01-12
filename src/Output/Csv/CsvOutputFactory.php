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

    public function createSimpleCsvOutput($resourcesBundle)
    {
        return new SimpleCsvOutput($resourcesBundle, $this->resourceFactory);
    }

    public function createExtendedCsvOutput($resourcesBundle)
    {
        return new ExtendedCsvOutput($resourcesBundle, $this->resourceFactory);
    }
}