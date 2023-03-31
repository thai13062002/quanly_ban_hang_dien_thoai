<?php

namespace App\Services;

class BaseService
{
    protected $model;

    public function create($params)
    {
        return $this->model->create($params);
    }

    public function update($id, $params)
    {
        $model = $this->model->find($id);
        $model->update($params);

        return $this->model->find($id);
    }

    public function delete($id)
    {
        $item = $this->find($id);

        return $item ? $item->delete() : true;
    }

    public function find($id, $with = null)
    {
        $query = $this->model;
        if ($with) {
            $query = $query->with($with);
        }

        $result = $query->findOrFail($id);

        return $result;
    }
    public function getAll()
    {
        return $this->model->latest()->paginate(10);
    }
}
