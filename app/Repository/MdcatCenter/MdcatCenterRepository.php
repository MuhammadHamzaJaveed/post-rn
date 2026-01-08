<?php

namespace App\Repository\MdcatCenter;
use App\Models\MdcatCenter;
use App\Repository\Base\BaseRepository;
use App\Repository\MdcatCenter\Interfaces\MdcatCenterRepositoryInterface;

class MdcatCenterRepository extends BaseRepository implements MdcatCenterRepositoryInterface
{
    /**
     * MdcatCenterRepository constructor.
     *
     * @param  MdcatCenter  $mdCenter
     */
    public function __construct(MdcatCenter $mdCenter)
    {
        parent::__construct($mdCenter);
    }
}