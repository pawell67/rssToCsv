<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource\Rss;

use PawelWankiewiczRekrutacjaHRtec\Resource\ResourceInterface;
use SimpleXMLElement;

class RssResource implements ResourceInterface
{
    protected $url;
    protected $content;

    public function __construct(array $commandLineArguments)
    {
        $this->checkUrlFormat($commandLineArguments);
    }

    public function checkUrlFormat(array $commandLineArguments): void
    {
        if (!isset($commandLineArguments[1])) {
            $this->url = $GLOBALS["URL"];
        } else if (!substr($this->url, 0, 7) === "http://" || !substr($this->url, 0, 8) === "https://") {
            die("Wrong URL format. URL should starts with `http://` or `https://`.");
        } else {
            $this->url = $commandLineArguments[1];
        }
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