<?php

namespace App\Model\Company\Service\Company\Factory;

class Data
{
    public bool $isAdmin;
    public string $url;
    public string $ssl;
    public array $settings;
    public array $descriptions;

    public function __construct(bool $isAdmin, string $url, string $ssl, array $settings, array $descriptions)
    {
        $this->isAdmin = $isAdmin;
        $this->url = $url;
        $this->ssl = $ssl;
        $this->settings = $settings;
        $this->descriptions = $descriptions;
    }
}
