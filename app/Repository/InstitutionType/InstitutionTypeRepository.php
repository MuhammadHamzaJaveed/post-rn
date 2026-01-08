<?php

namespace App\Repository\InstitutionType;
use App\Models\InstitutionType;
use App\Repository\Base\BaseRepository;
use App\Repository\InstitutionType\Interfaces\InstitutionTypeRepositoryInterface;

class InstitutionTypeRepository extends BaseRepository implements InstitutionTypeRepositoryInterface
{
    /**
     * InstitutionRepository constructor.
     *
     * @param  InstitutionType  $instType
     */
    public function __construct(InstitutionType $instType)
    {
        parent::__construct($instType);
    }
}