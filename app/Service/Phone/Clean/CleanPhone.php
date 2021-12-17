<?php

namespace App\Service\Phone\Clean;

class CleanPhone implements CleanPhoneInterface
{
    public function clean(string $phone): string
    {
        $dividedTelephone = explode('+', $phone);
        if(count($dividedTelephone) > 1){
            $cleanPhone = $dividedTelephone[1];
        }
        else{
            $cleanPhone = $dividedTelephone[0];
        }
        return preg_replace("/\D/", "", $cleanPhone);
    }
}
