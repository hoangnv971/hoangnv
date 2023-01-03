<?php
namespace Core\Repositories;

use Core\Models\Permission;
use Core\Repositories\BaseRepository;
use Core\Repositories\Contracts\PermissionRepositoryContract;

class PermissionRepository extends BaseRepository implements PermissionRepositoryContract
{
    public function model()
    {
        return PermissionRepository::class;
    }
}
