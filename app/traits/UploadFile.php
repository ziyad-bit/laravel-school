<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait UploadFile{
    public function uploadFile($file,string $path):string{
        $file_store   = $file;
        $fileName = time() . '-' . $file_store-> getClientOriginalName();
        $file_store->move($path,$fileName);

        return $fileName;
    }
}
