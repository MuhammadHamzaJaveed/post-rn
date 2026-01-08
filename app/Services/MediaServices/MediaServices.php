<?php

namespace App\Services\MediaServices;

use App\Repository\Media\Interfaces\MediaRepositoryInterface;

class MediaServices
{
    protected $mediaRepository;

    /**
     * MediaServices  constructor.
     *
     * @param MediaRepositoryInterface $mediaRepository
     */
    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function updateOrCreateUserProfileImage(array $search,  $imageData)
    {
        $formattedSize = $this->formatBytes($imageData['imageSize']);
        return $this->mediaRepository->updateOrCreate($search, $this->formatImageData($imageData, $formattedSize));
    }

    /**
     * @param $imageData
     * @param $formattedSize
     * @return array
     */
    private function formatImageData($imageData, $formattedSize): array
    {
        return [
            'path' => $imageData['imagePath'],
            'mediaable_type' => $imageData['model'],
            'mediaable_id' => $imageData['userId'],
            'name' => $imageData['imageName'],
            'disk' => $imageData['disk'],
            'collection' => $imageData['collection'],
            'size' => $formattedSize,
        ];
    }

    /**
     * @param $bytes
     * @param $precision
     * @return string
     */
    private function formatBytes($bytes, $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
