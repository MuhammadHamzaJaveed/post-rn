<?php

namespace App\Repository\PersonalDetails;

use App\Models\PersonalDetail;
use App\Repository\Base\BaseRepository;
use App\Repository\PersonalDetails\Interfaces\PersonalDetailsRepositoryInterface;

class PersonalDetailRepository extends BaseRepository implements PersonalDetailsRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  PersonalDetail  $personalDetail
     */
    public function __construct(PersonalDetail $personalDetail)
    {
        parent::__construct($personalDetail);
    }
}
