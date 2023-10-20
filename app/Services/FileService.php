<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService {

    public static function store(string $path, string|array $file, string $extension, string $filename)
    {
        $imageName = $filename .'.'. $extension;
        $imagePath = Storage::putFileAs($path, $file, $imageName);
        return $imagePath;
    }

    public static function remove(string|array $file)
    {
        Storage::delete($file);
    }

}