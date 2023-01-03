<?php
namespace Core\Repositories;

use Core\Models\Role;
use Core\Repositories\BaseRepository;
use Core\Repositories\Contracts\RoleRepositoryContract;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    public function model()
    {
        return Role::class;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function getNameWithSearch($search){
        return $this->model
                    ->select('name as text', 'id')
                    ->where('name', 'like',  "%$search%")
                    ->paginate();
    }
}
