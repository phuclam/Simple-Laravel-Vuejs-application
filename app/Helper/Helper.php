<?php


namespace App\Helper;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic;

class Helper
{
    public static function uploadPath($file)
    {
        $path = public_path('uploads') . '/' . date('Y/m/d');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path . '/' . $file;
    }

    public static function uploadUrl($file)
    {
        return '/uploads' . '/' . date('Y/m/d') . '/' . $file;
    }

    public static function uploadImage($data)
    {
        $base64 = substr($data, strpos($data, ",")+1);
        $pos  = strpos($data, ';');
        $type = explode(':', substr($data, 0, $pos))[1];

        switch ($type) {
            case 'image/jpeg': $ext = '.jpg';
                break;
            case 'image/png': $ext = '.png';
                break;
            default: $ext = '.jpg';
        }

        $name = md5(time()).$ext;
        $path = Helper::uploadPath($name);

        $image = base64_decode($base64);
        ImageManagerStatic::make($image)->save($path);

        return Helper::uploadUrl($name);
    }
}