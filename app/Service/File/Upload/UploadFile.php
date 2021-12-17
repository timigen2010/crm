<?php

namespace App\Service\File\Upload;

use Illuminate\Http\Request;

class UploadFile implements UploadFileInterface
{

    public function upload(Request $request, string $filename, string $dirSave, string $disk = "public"): string
    {
        return $request->file($filename)->store($dirSave, $disk);
    }
}
