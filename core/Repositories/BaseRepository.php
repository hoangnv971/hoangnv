<?php
namespace Core\Repositories;

use Core\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository 
{

    protected $model;

    public $datatableQuery, $dtColumn, $dtOrder, $dtStart, $dtLength, $dtSearch;

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

    public function getDataTable($request)
    {
        $this->datatableQuery = $this->model;

        if($search){

        }

        $users = $query->orderBy($columns[$order[0]['column']]['data'])
                            ->with('roles')
                            ->limit($length)
                            ->offset($start)
                            ->get();
        $total = $query->count();

        return compact('users', 'total');
    }

    public function dataTableSearching()
    {
        $query = null;
        if(empty($this->search)){
            foreach($this->columns as $column){
                if(in_array($column['data'], $withOutColumns)) continue;
                $query = $this->datatableQuery->orWhere($column['data'], 'like', "%$search%");
            }  
        }
    }


    public function processDataRequest($request)
    {
        $this->dtColumn = $request->column;
        $this->dtOrder = $request->dtOrder;
        $this->dtStart = $request->dtStart;
        $this->dtLength = $request->dtLength;
        $this->dtSearch = $request->search['value'];
    }

    public function queryDataTable()
    {
        $datatable = $this->
    }

}
