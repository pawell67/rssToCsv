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
            return "This URL is unreachable.";
        }

        return $this->convertToXML();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): string
    {
        $this->url = $url;
        return $this->url;
    }

    private function convertToXML()
    {
        set_error_handler(function ($errno, $errstr) {
            throw new \Exception($errstr, $errno);
        });

        try {
            return new SimpleXMLElement($this->content);
        } catch (\Exception $exception) {
            restore_error_handler();
            die("There is no relevant data in this URL.");
        }
    }
}