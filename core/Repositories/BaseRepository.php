<?php
namespace Core\Repositories;

use Core\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use DB;
abstract class BaseRepository 
{

    protected $model;

    public $datatableQuery, 
            $DTColumns, 
            $DTOrder = [], 
            $DTStart, 
            $DTLength, 
            $DTSearch, 
            $DTRelation, 
            $DTExceptColumns = [];

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

    public function dataTables()
    {
        $this->datatableQuery = $this->model;

        $this->withRelationDT()
                        ->searchDataTable()
                        ->queryDataTable()
                        ->limitDatatable()
                        ->offsetDatatable()
                        ->orderDatatable();

        return [
            'result' => clone $this->datatableQuery->get(),
            'total' => $this->totalResultDT()
        ];
    }

    public function totalResultDT()
    {
        $latest = $this->datatableQuery->latest()->getQuery()->offset = null;
        return $this->datatableQuery->count();
    }

    public function withRelationDT()
    {
        if(!empty($this->DTRelation)) return $this->datatableQuery = $this->datatableQuery->with($this->DTRelation);
        return $this;
    }

    public function searchDataTable()
    {
        if(!empty($this->DTSearch)){
            foreach($this->DTColumns as $column){
                if($this->checkColumnDT($column['data'])) continue;
                $this->datatableQuery = $this->datatableQuery->orWhere($column['data'], 'like', "%$this->DTSearch%");
            }  
        }
        return $this;
    }

    public function queryDataTable()
    {
        return $this;
    }

    public function limitDatatable()
    {
        $this->datatableQuery = $this->datatableQuery->limit($this->DTLength);
        return $this;
    }

    public function offsetDatatable()
    {
        $this->datatableQuery = $this->datatableQuery->offset($this->DTStart);
        return $this;
    }

    public function orderDatatable()
    {
        foreach($this->DTOrder as $order){
            $this->datatableQuery = $this->datatableQuery->orderBy($this->DTColumns[$order['column']]['data'], $order['dir']);
        }
        return $this;
    }

    public function fillData($request)
    {
        $this->DTColumns = $request->columns;
        $this->DTOrder = $request->order;
        $this->DTStart = $request->start;
        $this->DTLength = $request->length;
        $this->DTSearch = $request->search['value'];
        return $this;
    }

    public function setExceptColumnsDT($column = [])
    {
        $this->DTExceptColumns = $column;
        return $this;
    }

    protected function checkColumnDT($columns)
    {
        return in_array($columns, $this->DTExceptColumns);
    }


}
