<?php

namespace App\Http\Livewire\Users;

use App\Services\UserServices\UserServices;
use Livewire\Component;

class Users extends Component
{
    protected $userServices;

    public $searchByName = '';

    public $perPage = 5;

    /**
     * Summary of boot
     * @param UserServices $userServices
     * @return void
     */
    public function boot(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllUsersProperty()
    {
         return $this->userServices->getAllUsersPaginatedResults(
            $this->perPage,
            $this->searchByName,
            ["roles"]
        );
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.users.users')
            ->extends('layouts.app')
            ->section('content');
    }
}