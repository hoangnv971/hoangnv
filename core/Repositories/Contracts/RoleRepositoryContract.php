<?php 
namespace Core\Repositories\Contracts;

interface RoleRepositoryContract
{
    public function getByName($name);
}
