<?php

namespace App\Repository\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Base\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param  array  $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     * @return mixed
     */
    public function update(array $attributes, int $id): object
    {
        return tap($this->model->find($id))->update($attributes);
    }

    /**
     * @param  int  $id
     * @param  array  $with
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id, array $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param  array  $data
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function findBy(array $data, array $with = [], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->where($data)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @param  array  $data
     * @param  array  $with
     * @param  array  $withCount
     * @return mixed
     */
    public function findOneBy(array $data, array $with = [], array $withCount = [])
    {
        return $this->model->where($data)->with($with)->withCount($withCount)->first();
    }

    /**
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param  array  $attributes
     * @return bool
     */
    public function insert(array $attributes): bool
    {
        return $this->model->query()->insert($attributes);
    }

    /**
     * @param  array  $columns
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return Builder[]|Collection
     */
    public function all(array $columns = ['*'], array $with = [], string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->with($with)->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param  array  $columns
     * @param  array  $where
     * @param  array  $with
     * @param  string  $orderBy
     * @param  string  $sortBy
     * @return mixed
     */
    public function allWhere(
        array $columns = ['*'],
        array $where = [],
        array $with = [],
        string $orderBy = 'id',
        string $sortBy = 'asc'
    ): mixed {
        return $this->model->query()->select($columns)->where($where)->with($with)->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @return mixed
     */
    public function newModelInstance()
    {
        return new $this->model();
    }

    /**
     * @param  array  $search
     * @param  array  $attributes
     * @return mixed
     */
    public function updateOrCreate(array $search, array $attributes)
    {
        return $this->model->updateOrCreate($search, $attributes);
    }
}
