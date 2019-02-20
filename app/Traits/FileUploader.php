<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Storage;
use Image;

trait FileUploader
{
    public function uploadImage($file, $filename, $disk)
    {
        $filename = str_slug($filename) . '.' . $file->getClientOriginalExtension();
        $image = Image::make($file);
        $thumb = Image::make($file);

        $thumb->fit(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk($disk)->put($filename, (string) $image->encode());
        Storage::disk($disk)->put('thumb/'.$filename, (string) $thumb->encode());
        return $filename;
    }

  public function deleteOldImage($disk, $filename)
  {
  	if (Storage::disk($disk)->exists($filename)) {
    	Storage::disk($disk)->delete($filename);
        Storage::disk($disk)->delete('thumb/'.$filename);
    }
  }
}
