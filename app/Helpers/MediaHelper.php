<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class MediaHelper
{
    /**
     * @param $path
     * @return string
     */
    public static function GetImageUrl($path): string
    {
        /*return Storage::disk('public')->url($path);*/
        return 'storage/' . $path;
    }
}