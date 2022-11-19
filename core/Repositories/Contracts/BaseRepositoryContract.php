<?php 
namespace Core\Repositories\Contracts;

interface BaseRepositoryContract
{
    public function get($columns = ["*"]);

    public function find($id);

    public function create($data);

    public function updateById($id, $data);

    public function delete($id);

    public function deleteMultipleById($ids = []);

    public function getUserTable($columns, $order, $start, $length, $search, $withOutColumns);
}
