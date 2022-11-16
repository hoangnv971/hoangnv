<?php 
namespace Core\Services;

use Core\Repositories\Contracts\UserRepositoryContract;
use Core\Repositories\Contracts\RoleRepositoryContract;
use Core\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class UserService implements UserServiceContract
{
    protected $userRepo;
    protected $roleRepo;
    const ID_ROLE_USER = 2;

    public function __construct(UserRepositoryContract $userRepo, RoleRepositoryContract $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function createUser($data = [], $roleId = self::ID_ROLE_USER) // user permission
    {
        $validator = Validator::make($data, ['email' => 'unique:users']);
        if ($validator->fails()) {
            return [
                'status' => 0,
                'errors' => $validator->errors()
            ];
        }
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        $user = $this->userRepo->create($data);
        $user->roles()->attach($roleId);
        return [
            'status' => 1,
            'message' => 'Success!',
            'user' => $user
        ];
    }

    public function dataTable($request)
    {
        $users = $this->userRepo->with('roles')->all();

        return $users;
    }
}