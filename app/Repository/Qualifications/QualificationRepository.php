<?php

namespace App\Repository\Qualifications;

use App\Models\Qualification;
use App\Repository\Base\BaseRepository;
use App\Repository\Qualifications\Interfaces\QualificationRepositoryInterface;

class QualificationRepository extends BaseRepository implements QualificationRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  Qualification  $qualification
     */
    public function __construct(Qualification $qualification)
    {
        parent::__construct($qualification);
    }
}
