<?php

namespace App\Http\Livewire\Components\CreateEditDepartment;

use Illuminate\Contracts\Foundation\Application;
use LivewireUI\Modal\ModalComponent;
use App\Services\DepartmentServices\DepartmentServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class CreateEditDepartment extends ModalComponent
{
    protected $departmentServices;

    public $department;

    public $heading;

    public $name;

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

     /**
     * Summary of boot
     * @param  DepartmentServices  $departmentServices
     * @return void
     */
    public function boot(DepartmentServices $departmentServices)
    {
        $this->departmentServices = $departmentServices;
    }

    /**
     * @param  int|null  $departmentId
     * @return string|void
     */
    public function mount(int $departmentId = null)
    {
        if ($departmentId) {
            $this->department = $this->departmentServices->findDepartmentById($departmentId)[0];
            $this->name         = $this->department->name;

            return $this->heading = 'Update Department';
        }

        $this->heading = 'Create New Department';
    }

    /**
     * @return Application|Redirector|RedirectResponse
     */
    public function submit()
    {
        $departmentData = $this->validate();
        
        if (! $this->department){
            $this->department = $this->departmentServices->createDepartment($departmentData);
            $message = "The Department has been added successfully";
        } else {
            $this->department = $this->departmentServices->updateDepartment(
                $departmentData,
                $this->department->id
            );

            $message = "The Department has been edited successfully";
        }

        Session::flash(
            'primary',
            $message
        );

        return redirect(route('department'));
    }

    public function render()
    {
        return view('livewire.components.create-edit-department.create-edit-department')
        ->extends('layouts.app')
        ->section('content');
    }
}
