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
        $GLOBALS = [
            "OUTPUT_FILE_NAME" => "file.csv",
            "URL" => "http://feeds.nationalgeographic.com/ng/News/News_Main",
            "OUTPUT_DIRECTORY" => "output/",
            "COLUMNS_HEADERS" => ["title", "description", "link", "pubDate", "creator"],
            "_SERVER" => ["SCRIPT_NAME" => "console.php"]
        ];
        $this->resourcesBundle = ["http://maxburstein.com/rss", "file01.csv"];
        $this->rssResource = new RssResource($this->resourcesBundle);
    }

    public function testCanGetUrl(): void
    {
        $this->assertEquals("http://maxburstein.com/rss", $this->rssResource->getUrl());
    }

    public function testCanGetContent(): void
    {
        $this->url = $this->rssResource->getUrl();
        $content = $this->rssResource->getContent();
        $this->assertInstanceOf(SimpleXMLElement::class, $content);
    }
}