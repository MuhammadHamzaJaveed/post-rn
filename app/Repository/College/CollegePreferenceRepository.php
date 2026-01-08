<?php

namespace App\Repository\College;

use App\Models\CollegePreference;
use App\Repository\Base\BaseRepository;
use App\Repository\College\Interfaces\CollegePreferenceRepositoryInterface;

class CollegePreferenceRepository extends BaseRepository implements CollegePreferenceRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  CollegePreference  $collegePreference
     */
    public function __construct(CollegePreference $collegePreference)
    {
        parent::__construct($collegePreference);
    }
}
