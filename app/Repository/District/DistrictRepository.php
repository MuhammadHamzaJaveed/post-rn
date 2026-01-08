<?php

namespace App\Repository\District;

use App\Models\District;
use App\Repository\Base\BaseRepository;
use App\Repository\District\Interfaces\DistrictRepositoryInterface;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  District  $district
     */
    public function __construct(District $district)
    {
        parent::__construct($district);
    }
}
