<?php

namespace App\Repository\ResidenceArea;

use App\Models\ResidenceArea;
use App\Repository\Base\BaseRepository;
use App\Repository\ResidenceArea\Interfaces\ResidenceAreaRepositoryInterface;

class ResidenceAreaRepository extends BaseRepository implements ResidenceAreaRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  ResidenceArea  $residenceArea
     */
    public function __construct(ResidenceArea $residenceArea)
    {
        parent::__construct($residenceArea);
    }
}
