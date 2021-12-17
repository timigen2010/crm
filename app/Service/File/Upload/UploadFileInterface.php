<?php

namespace App\Service\File\Upload;

use Illuminate\Http\Request;

interface UploadFileInterface
{
    /**
     * @param Request $request
     * @param string $filename
     * @param string $dirSave
     * @param string $disk
     * @return mixed
     */
    public function upload(Request $request, string $filename, string $dirSave, string $disk = "public");
}
