<?php

namespace App\Repository\Department;

use App\Models\Department;
use App\Repository\Base\BaseRepository;
use App\Repository\Department\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  Department  $department
     */
    public function __construct(Department $department)
    {
        parent::__construct($department);
    }
}
