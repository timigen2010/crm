<?php

namespace App\Model\Language\Service\Factory;

class Data
{
    public string $name;
    public string $code;
    public string $locale;
    public ?string $image;
    public bool $status;

    public function __construct(string $name, string $code, string $locale, ?string $image, bool $status)
    {
        $this->name = $name;
        $this->code = $code;
        $this->locale = $locale;
        $this->image = $image ?? '';
        $this->status = $status;
    }
}
