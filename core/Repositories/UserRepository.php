<?php
namespace Core\Repositories;

use Core\Models\User;
use Core\Repositories\BaseRepository;
use Core\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function model()
    {
        return User::class;
    }
}
