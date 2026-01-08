<?php

namespace App\Repository\Media;

use App\Models\Media;
use App\Repository\Base\BaseRepository;
use App\Repository\Media\Interfaces\MediaRepositoryInterface;

class MediaRepository extends BaseRepository implements MediaRepositoryInterface
{
    /**
     * MediaRepository constructor.
     *
     * @param  Media  $media
     */
    public function __construct(Media $media)
    {
        parent::__construct($media);
    }
}
