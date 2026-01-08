<?php

namespace App\Repository\SscExamPassed;

use App\Models\SscExamPassed;
use App\Repository\Base\BaseRepository;
use App\Repository\SscExamPassed\Interfaces\SscExamPassedRepositoryInterface;

class SscExamPassedRepository extends BaseRepository implements SscExamPassedRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  SscExamPassed  $exam
     */
    public function __construct(SscExamPassed $exam)
    {
        parent::__construct($exam);
    }
}
