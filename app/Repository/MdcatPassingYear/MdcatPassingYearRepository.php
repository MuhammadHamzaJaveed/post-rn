<?php

namespace App\Repository\MdcatPassingYear;
use App\Models\MdcatPassingYear;
use App\Repository\Base\BaseRepository;
use App\Repository\MdcatPassingYear\Interfaces\MdcatPassingYearRepositoryInterface;

class MdcatPassingYearRepository extends BaseRepository implements MdcatPassingYearRepositoryInterface
{
    /**
     * MdcatPassingYearRepository constructor.
     *
     * @param  MdcatPassingYear  $mdCenter
     */
    public function __construct(MdcatPassingYear $mdPassingYear)
    {
        parent::__construct($mdPassingYear);
    }
}