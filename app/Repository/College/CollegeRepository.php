<?php

namespace App\Repository\College;

use App\Models\College;
use App\Repository\Base\BaseRepository;
use App\Repository\College\Interfaces\CollegeRepositoryInterface;

class CollegeRepository extends BaseRepository implements CollegeRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  College  $college
     */
    public function __construct(College $college)
    {
        parent::__construct($college);
    }
}
