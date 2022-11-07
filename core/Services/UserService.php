<?php 
namespace Core\Services;

use Core\Repositories\Contracts\UserRepositoryContract;
use Core\Services\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
    protected $userRes;

    public function __construct(UserRepositoryContract $userRes)
    {
        $this->userRes = $userRes;
    }

    public function createUser()
    

}