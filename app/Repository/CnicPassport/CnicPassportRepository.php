<?php

namespace App\Repository\CnicPassport;

use App\Models\CnicPassport;
use App\Repository\Base\BaseRepository;
use App\Repository\CnicPassport\Interfaces\CnicPassportRepositoryInterface;

class CnicPassportRepository extends BaseRepository implements CnicPassportRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  CnicPassport  $cnicPassport
     */
    public function __construct(CnicPassport $cnicPassport)
    {
        parent::__construct($cnicPassport);
    }
}
