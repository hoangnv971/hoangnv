<?php 
namespace Core\Services;

use Core\Repositories\Contracts\UserRepositoryContract;
use Core\Repositories\Contracts\RoleRepositoryContract;
use Core\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
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

    public function createUser($data = [], $roleId = 2) // user permission
    {
        $validator = Validator::make($data, [
                                    'email' => 'unique:users|required',
                                    'password' => 'required'
                                ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);
        DB::beginTransaction();
        try{
            $user = $this->userRepo->create($data);
        }catch(\Exception $e){
            DB::rollBack();
            Log::errors($e->getMessage());
            throw new InvalidArgumentException('Account creation failed!');
        }
        $user->roles()->attach($roleId);
        DB::commit();
        return $user;
    }

    public function dataTable($request)
    {
        $result = $this->userRepo->processDataRequest($request)->getUserTable(
                                    $request['columns'],
                                    $request['order'],
                                    $request['start'],
                                    $request['length'],
                                    $request['search']['value'],
                                    ['roles', 'action']
                                );
        return $this->processDataResponse($result);
    }

    private function processDataResponse($data)
    {
        $users = [];
        foreach($data['users'] as $key => $user){
            $users[$key]['id'] = $user->id;
            $users[$key]['name'] = $user->name;
            $users[$key]['email'] = $user->email;
            $users[$key]['roles'] = $user->roles->pluck('name')->implode(', ');
            $users[$key]['action'] = "
                <div class='btn-group'>
                    <div class='btn btn-primary'>Sửa</div>
                    <div class='btn btn-danger'>Xóa</div>
                </div>
            ";
        }
        $data['users'] = $users;
        return $data;
    }
}