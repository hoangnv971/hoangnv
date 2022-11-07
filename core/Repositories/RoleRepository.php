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
}
