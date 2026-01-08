<?php

namespace App\Repository\ExamPassed;

use App\Models\ExamPassed;
use App\Repository\Base\BaseRepository;
use App\Repository\ExamPassed\Interfaces\ExamPassedRepositoryInterface;

class ExamPassedRepository extends BaseRepository implements ExamPassedRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  ExamPassed  $exam
     */
    public function __construct(ExamPassed $exam)
    {
        parent::__construct($exam);
    }
}
