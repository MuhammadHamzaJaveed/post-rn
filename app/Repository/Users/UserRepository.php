<?php

namespace App\Repository\Users;

use App\Models\User;
use App\Repository\Base\BaseRepository;
use App\Repository\Users\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
