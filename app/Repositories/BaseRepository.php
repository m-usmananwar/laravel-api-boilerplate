<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        return $this->create($data);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $instance = $this->findOrFail($id);
        $instance->fill($data);
        $instance->save();
        return $instance;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete($id)
    {
        $model = $this->findOrFail($id);
        $model->delete();
    }

    public function getSingle($id)
    {
        return $this->model::findOrFail($id);
    }

    public function getPaginated($data = [])
    {

        $perPage = $data["per_page"] ?? config("general.request.perPage");
        $query = $this->model::listingInfo()->filters($data);

        $this->model->timestamps ? $query->latest() : $query->latest("id");

        return $query->paginate($perPage);
    }
}
