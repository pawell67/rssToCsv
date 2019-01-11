<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource\Rss;

class RssResourceFactory
{
    public function create($commandLineArguments): RssResource
    {
        return new RssResource($commandLineArguments);
    }
}