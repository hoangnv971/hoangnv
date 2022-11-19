<?php
namespace Core\Repositories;

use Core\Models\Base;
use Core\Repositories\Contracts\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements BaseRepositoryContract
{

    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = app()->make($this->model());

        if (! $model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of ".Model::class);
        }

        return $this->model = $model;
    }

    public function get($columns = ["*"])
    {
        return $this->model->get($columns);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function updateById($id, $data)
    {
        $result = $this->model->find($id);
        if($result){
            return $result->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->model->find($id);
        if($result){
            return $result->delete();
        }
        return false;
    }

    public function deleteMultipleById($ids = [])
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function getUserTable($columns, $order, $start, $length, $search, $withOutColumns)
    {
        $query = $this->model;
        if($search){
            foreach($columns as $column){
                if(in_array($column['data'], $withOutColumns)) continue;
                $query = $query->orWhere($column['data'], 'like', "%$search%");
            }  
        }

        $users = $query->orderBy($columns[$order[0]['column']]['data'])
                            ->with('roles')
                            ->limit($length)
                            ->offset($start)
                            ->get();
        $total = $query->count();

        return compact('users', 'total');
    }
}
