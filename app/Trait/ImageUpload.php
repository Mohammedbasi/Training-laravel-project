<?php

namespace App\Trait;


use Illuminate\Http\Request;

trait ImageUpload
{
    public function uploadImage(Request $request,$type,$place)
    {
        if (!$request->hasFile($type)) {
            return;
        }
        $file = $request->file($type);
        $path = $file->store($place, [
            'disk' => 'public',
        ]);
        return $path;
    }
}
