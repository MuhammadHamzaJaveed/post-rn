<?php

namespace App\Services\DepartmentServices;

use App\Repository\Department\Interfaces\DepartmentRepositoryInterface;

class DepartmentServices
{
    protected $departmentRepository;

    /**
     * UserServices  constructor.
     *
     * @param DepartmentRepositoryInterface $departmentRepository
     */
    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param  int  $perPage
     * @param  string  $searchName
     * @param  array  $with
     * @return mixed
     */
    public function getAllDepartmentPaginatedResults(
        int    $perPage,
        string $searchName,
        array  $with = []
    )
    {
        $department = $this->departmentRepository->newModelInstance()::query();

        if (!blank($searchName)) {
            $department->where('name', 'like', '%' . $searchName . '%');
        }

        return $department->with($with)->paginate($perPage);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findDepartmentById(int $id)
    {
        return $this->departmentRepository->findBy(['id' => $id]);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function createDepartment(array $attributes)
    {
        return $this->departmentRepository->create($attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     * @return mixed
     */
    public function updateDepartment(array $attributes, int $id)
    {
        return $this->departmentRepository->update($attributes, $id);
    }
}
