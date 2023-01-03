<?php 
namespace Core\Services;

use Core\Services\Contracts\RoleServiceContract;
use Core\Repositories\Contracts\RoleRepositoryContract;

class RoleService implements RoleServiceContract
{
    protected $roleRepo;

    public function __construct(RoleRepositoryContract $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function getRolesList($request){
        $search = isset($request['q']) ? $request['q'] : "";
        $roles = $this->roleRepo->getNameWithSearch($search);
        $roles->appends(['q'=> $search]);
        return [
            'status' => 1,
            'message' => 'sucessful',
            'data' => $roles
        ];
    }
    

}