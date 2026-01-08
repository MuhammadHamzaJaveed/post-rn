<?php

namespace App\Repository\Program;

use App\Models\Program;
use App\Repository\Base\BaseRepository;
use App\Repository\Program\Interfaces\ProgramRepositoryInterface;

class ProgramRepository extends BaseRepository implements ProgramRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  Program  $program
     */
    public function __construct(Program $program)
    {
        parent::__construct($program);
    }
}
