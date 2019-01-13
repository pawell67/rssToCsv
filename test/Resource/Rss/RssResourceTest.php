<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource\Rss;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class RssResourceTest extends TestCase
{
    protected $rssResource;
    protected $resourcesBundle;
    protected $url;

    public function setUp(): void
    {
        $this->resourcesBundle = ["http://maxburstein.com/rss", "file01.csv"];
        $this->rssResource = new RssResource($this->resourcesBundle);
    }

    public function testCanGetUrl(): void
    {
        $this->assertEquals("http://maxburstein.com/rss", $this->rssResource->getUrl());
    }

    public function testCanGetContent()
    {
        $this->url = $this->rssResource->getUrl();
        $content = $this->rssResource->getContent();
        $this->assertInstanceOf(SimpleXMLElement::class, $content);
    }

    public function testCanNotGetContent()
    {
        $this->rssResource->setUrl("http://maxburtein.com");
        $content = $this->rssResource->getContent();
        $this->assertEquals("This URL is unreachable.", $content);
    }
}