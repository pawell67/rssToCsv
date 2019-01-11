<?php

namespace PawelWankiewiczRekrutacjaHRtec\Resource;

interface ResourceInterface
{
    public function getContent();

    public function getUrl(): string;

    public function checkUrlFormat(array $commandLineArguments): void;
}
