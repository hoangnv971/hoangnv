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
        $validator = $this->validatorUser($data);
        if($validator->fails()) {
            return[
                'status' => 0, 
                'messages' => $validator->errors(), 
                'data' => [],
                'msgType' => 'error'
            ];
        }
        $data = $this->filterDataStore($data);
        return [
            'status' => 1,
            'messages' => ['Successful!' => ''],
            'msgType' => 'success',
            'data' => $this->userRepo->create($data)
        ];
    }
    private function validatorUser($data)
    {
        return Validator::make($data, [
                                    'name' => 'required',
                                    'email' => 'unique:users|required|email',
                                    'password' => 'required'
                                ]);
    }
    private function filterDataStore($data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = $this->checkRoleId($data);
        return $data;
    }
    private function checkRoleId($data) {
        return isset($data['role_id']) ? $data['role_id'] : 2;
    }
    public function dataTable($request)
    {
        $result = $this->userRepo
                        ->fillData($request)
                        ->setExceptColumnsDT(['roles', 'action'])
                        ->dataTable();
        return $this->processDataResponse($result);
    }
    private function processDataResponse($data)
    {
        $users = [];
        foreach($data['result'] as $user){
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
        return "<a class='btn btn-primary btn-sm edit-user' alt='edit' href='".route('admin.users.edit', ['user' => $id])."'><i class='fas fa-pencil-alt'></i> </a>
                <a class='btn btn-danger btn-sm remove-user' alt='remove' href='".route('admin.users.destroy', ['user' => $id])."'><i class='fas fa-trash'></i> </a>";
    }
}