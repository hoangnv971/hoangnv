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

    public function storeUser($data = []) // user permission
    {
        $this->validatorUser($data);
        $data = $this->filterDataStore($data);
        return $this->userRepo->create($data);    
    }

    private function validatorUser($data)
    {
        $validator = Validator::make($data, [
                                    'email' => 'unique:users|required',
                                    'password' => 'required'
                                ]);
        if ($validator->fails()) {
            throw new InvalidOrderException($validator->errors()->toArray());
        }

        return $data;
    }

    private function filterDataStore($data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = isset($data['role_id']) ? $data['role_id'] : 2;
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
            $users[] = $this->fillUserResponse($user);
        }
            
        return [
            'data' => $users,
            'recordsTotal' => $data['total'],
            'recordsFiltered' => $data['total'],
        ];
    }

    private function fillUserResponse($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => empty($user->role) ? '' : $user->role->name ,
            'action' => $this->btnCURD($user->id),
        ];
    }

    private function btnCURD($id) {
        return "<a class='btn btn-primary btn-sm' alt='edit' href='#'><i class='fas fa-pencil-alt'></i> </a>
                <a class='btn btn-danger btn-sm' alt='remove' href='#'><i class='fas fa-trash'></i> </a>";
    }
}