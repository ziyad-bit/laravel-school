<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait UploadImage{
    public function uploadphoto($image,string $path):string{
        $file     = $image;
        $img = Image::make($file)->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        
        $fileName = time() . '-' . $file-> getClientOriginalName();
        $img->save(public_path($path.$fileName));

        return $fileName;
    }
}
