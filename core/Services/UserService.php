<?php 
namespace Core\Services;

use Core\Repositories\Contracts\UserRepositoryContract as UserRepository;
use Core\Repositories\Contracts\RoleRepositoryContract as RoleRepository;
use Core\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class UserService implements UserServiceContract
{
    protected $userRes;
    protected $roleRes;
    const ID_ROLE_USER = 2;

    public function __construct(UserRepository $userRes, RoleRepository $roleRes)
    {
        $this->userRes = $userRes;
        $this->roleRes = $roleRes;
    }

    public function createUser($data = [], $roleId = self::ID_ROLE_USER) // user permission
    {
        $validator = Validator::make($data,['email' => 'unique:users']);
        if ($validator->fails()) {
            return [
                'status' => 0,
                'errors' => $validator->errors()
            ];
        }
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        $user = $this->userRes->create($data);
        $user->roles()->attach($roleId);
        return [
            'status' => 1,
            'message' => 'Success!',
            'user' => $user
        ];
    }
}