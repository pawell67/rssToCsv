<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource\Rss;

use PawelWankiewiczRekrutacjaHRtec\Resource\ResourceInterface;
use SimpleXMLElement;

class RssResource implements ResourceInterface
{
    protected $url;
    protected $content;

    public function __construct(array $resourcesBundle)
    {
        $this->url = $resourcesBundle[0];
    }

    public function getContent()
    {
        $this->content = @file_get_contents($this->url);
        if ($this->content === false) {
            die("This URL is unreachable.");
        }
        $this->convertToXML();
        return $this->content;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    private function convertToXML(): void
    {
        set_error_handler(function ($errno, $errstr) {
            throw new \Exception($errstr, $errno);
        });
        try {
            $this->content = new SimpleXMLElement($this->content);
        } catch (\Exception $exception) {
            restore_error_handler();
            die("There is no relevant data in this URL");
        }
    }
}