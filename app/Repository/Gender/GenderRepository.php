<?php

namespace App\Repository\Gender;

use App\Models\Gender;
use App\Repository\Base\BaseRepository;
use App\Repository\Gender\Interfaces\GenderRepositoryInterface;

class GenderRepository extends BaseRepository implements GenderRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  Gender  $gender
     */
    public function __construct(Gender $gender)
    {
        parent::__construct($gender);
    }
}
