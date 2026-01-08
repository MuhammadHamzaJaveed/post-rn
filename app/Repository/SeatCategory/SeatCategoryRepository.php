<?php

namespace App\Repository\SeatCategory;

use App\Models\SeatCategory;
use App\Repository\Base\BaseRepository;
use App\Repository\SeatCategory\Interfaces\SeatCategoryRepositoryInterface;

class SeatCategoryRepository extends BaseRepository implements SeatCategoryRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  SeatCategory  $seatCategory
     */
    public function __construct(SeatCategory $seatCategory)
    {
        parent::__construct($seatCategory);
    }
}
