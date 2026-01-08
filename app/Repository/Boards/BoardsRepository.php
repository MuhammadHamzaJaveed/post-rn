<?php

namespace App\Repository\Boards;

use App\Models\Boards;
use App\Repository\Base\BaseRepository;
use App\Repository\Boards\Interfaces\BoardsRepositoryInterface;

class BoardsRepository extends BaseRepository implements BoardsRepositoryInterface
{
    /**
     * DepartmentRepository constructor.
     *
     * @param  Boards  $boards
     */
    public function __construct(Boards $boards)
    {
        parent::__construct($boards);
    }
}
