<?php

namespace App\Service\Phone\Clean;

interface CleanPhoneInterface
{
    public function clean(string $phone): string;
}
