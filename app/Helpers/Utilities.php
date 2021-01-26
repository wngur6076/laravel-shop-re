<?php

namespace App\Http\Utility;

class File
{
    const BASENAME = 'apple.jpg';

    public static function upload($file)
    {
        $filename = \Str::random() . filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
        $file->move(public_path('files'), $filename);

        return $filename;
    }

    public static function delete($name)
    {
        $url = public_path('files/' . $name);
        if (file_exists($url)) {
            unlink($url);
        }
    }
}
