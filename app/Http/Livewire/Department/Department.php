<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Services\DepartmentServices\DepartmentServices;

class Department extends Component
{
    protected $departmentServices;

    public $searchByName = '';

    public $perPage = 5;

    /**
     * Summary of boot
     * @param DepartmentServices $departmentServices
     * @return void
     */
    public function boot(DepartmentServices $departmentServices)
    {
        $this->departmentServices = $departmentServices;
    }

    /**
     * Summary of getAllUsersProperty
     * @return mixed
     */
    public function getAllDepartmentProperty()
    {
         return $this->departmentServices->getAllDepartmentPaginatedResults(
            $this->perPage,
            $this->searchByName,
            ['users'],
        );
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.department.department')
        ->extends('layouts.app')
        ->section('content');
    }
}
