<?php 
namespace Core\Services\Contracts;

interface UserServiceContract
{
	public function createUser($data = [], $roleId = self::ID_ROLE_USER);
}
