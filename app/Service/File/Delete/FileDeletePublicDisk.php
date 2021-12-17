<?php

namespace App\Service\File\Delete;

use Illuminate\Support\Facades\Storage;

class FileDeletePublicDisk implements FileDeleteInterface
{

    public function delete(string $path)
    {
        Storage::disk('public')->delete($path);
    }
}
