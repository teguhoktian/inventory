<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait UploadFileTrait
{
    public function uploadFile($image, $location = 'public/upload')
    {
        $name = NULL;
        if (!is_null($image)) {
            $filename = Str::slug($image->getClientOriginalName(), '-');
            $name = time() . '-' . $filename . '.' . $image->getClientOriginalExtension();
            $image->storeAs($location, $name);
        }
        return $name;
    }
}
