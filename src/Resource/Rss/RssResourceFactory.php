<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource\Rss;

class RssResourceFactory
{
    public function create($resourcesBundle): RssResource
    {
        return new RssResource($resourcesBundle);
    }
}