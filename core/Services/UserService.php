<?php 
namespace Core\Services;

use Core\Repositories\Contracts\UserRepositoryContract;
use Core\Repositories\Contracts\RoleRepositoryContract;
use Core\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Core\Exceptions\InvalidOrderException;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceContract
{
    protected $userRepo;
    protected $roleRepo;

    public function __construct(UserRepositoryContract $userRepo, RoleRepositoryContract $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function createUser($data = []) // user permission
    {
        $validator = Validator::make($data, [
                                    'email' => 'unique:users|required',
                                    'password' => 'required'
                                ]);
        if ($validator->fails()) {
            throw new InvalidOrderException($validator->errors());
        }
        $data = $this->hasPassword($data);
        
        return $this->userRepo->create($data);    
    }

    private function hasPassword($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    public function dataTable($request)
    {
        $result = $this->userRepo
                        ->fillData($request)
                        ->setExceptColumnsDT(['roles', 'action'])
                        ->dataTables();
        return $this->processDataResponse($result);
    }

    private function processDataResponse($data)
    {
        $users = [];
        foreach($data['result'] as $key => $user){
            $users[$key]['id'] = $user->id;
            $users[$key]['name'] = $user->name;
            $users[$key]['email'] = $user->email;
            $users[$key]['roles'] = $user->roles->isEmpty() ? $user->roles->pluck('name')->implode(', ') : '';
            $users[$key]['action'] = "
                <div class='btn-group'>
                    <div class='btn btn-primary'>Sửa</div>
                    <div class='btn btn-danger'>Xóa</div>
                </div>
            ";
        }
        return [
            'data' => $users,
            'recordsTotal' => $data['total'],
            'recordsFiltered' => $data['total'],
        ];
    }
}