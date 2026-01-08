<?php

namespace App\Repository\AdmissionTest;

use App\Models\AdmissionTest;
use App\Repository\AdmissionTest\Interfaces\AdmissionTestRepositoryInterface;
use App\Repository\Base\BaseRepository;

class AdmissionTestRepository extends BaseRepository implements AdmissionTestRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  AdmissionTest  $admissionTest
     */
    public function __construct(AdmissionTest $admissionTest)
    {
        parent::__construct($admissionTest);
    }
}
