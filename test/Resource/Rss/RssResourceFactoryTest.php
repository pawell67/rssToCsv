<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource\Rss;

use PHPUnit\Framework\TestCase;

class RssResourceFactoryTest extends TestCase
{
    protected $factory;
    protected $resourcesBundle;

    public function setUp(): void
    {
        $this->factory = new RssResourceFactory();
        $this->resourcesBundle = ["http://maxburstein.com/rss", "file01.csv"];
    }

    public function testRssFactoryCreate(): void
    {
        $rssResource = $this->factory->create($this->resourcesBundle);
        $this->assertInstanceOf(RssResource::class, $rssResource);
    }
}