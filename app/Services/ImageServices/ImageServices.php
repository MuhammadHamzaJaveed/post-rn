<?php

namespace App\Services\ImageServices;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageServices
{
    public function formatImageData($image, $collection, $status=false): array
    {
        $newWidth = 700;
        $newHeight = 600;

        $sourcePath = $this->getImagePath($image);

        $extension = $image->extension();
        $originalImage = $this->loadImage($sourcePath, $extension);

        list($width, $height) = getimagesize($sourcePath);

        $resizedImage = $this->resizeImage($originalImage, $width, $height, $newWidth, $newHeight);

        $storagePath = $this->generateStoragePath($collection, $extension, $status);
        $imagePath = storage_path('app/public/' . $storagePath);

        $this->ensureDirectoryExists(dirname($imagePath));
        $this->saveImage($resizedImage, $imagePath, $extension);

        imagedestroy($originalImage);
        imagedestroy($resizedImage);

        return $this->getFormattedImageData($storagePath, $collection, $extension, $imagePath);
    }

    private function getImagePath($image)
    {
        $sourcePath = $image->getRealPath();
        if (!file_exists($sourcePath)) {
            throw new Exception('File does not exist at the specified path');
        }
        return $sourcePath;
    }

    private function loadImage($path, $extension)
    {
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($path);
            case 'png':
                return imagecreatefrompng($path);
            case 'gif':
                return imagecreatefromgif($path);
            default:
                throw new Exception('Unsupported image type');
        }
    }

    private function resizeImage($originalImage, $width, $height, $newWidth, $newHeight)
    {
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        return $resizedImage;
    }

    private function generateStoragePath($collection, $extension, $status)
    {
        if ($status) {
            return auth()->user()->name . '_' . auth()->user()->id . '_images/' . $collection .'.' . $extension;
        }
        return auth()->user()->id . '_images/' . $collection . '.' . $extension;
    }

    private function ensureDirectoryExists($directoryPath)
    {
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
    }

    private function saveImage($resizedImage, $path, $extension)
    {
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($resizedImage, $path, 90);
                break;
            case 'png':
                imagepng($resizedImage, $path);
                break;
            case 'gif':
                imagegif($resizedImage, $path);
                break;
        }
    }

    private function getFormattedImageData($storagePath, $collection, $extension, $imagePath)
    {
        return [
            'imageName'  => $collection . '.' . $extension,
            'imagePath'  => $storagePath,
            'imageSize'  => filesize($imagePath),
            'userId'     => auth()->user()->id,
            'model'      => User::class,
            'disk'       => 'public',
            'collection' => $collection,
        ];
    }
}
