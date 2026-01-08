<?php

namespace App\Repository\Nationality;

use App\Models\Nationality;
use App\Repository\Base\BaseRepository;
use App\Repository\Nationality\Interfaces\NationalityRepositoryInterface;

class NationalityRepository extends BaseRepository implements NationalityRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  Nationality  $nationality
     */
    public function __construct(Nationality $nationality)
    {
        parent::__construct($nationality);
    }
}
