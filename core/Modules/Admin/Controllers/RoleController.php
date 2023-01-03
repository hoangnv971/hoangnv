<?php

namespace Core\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\Contracts\RoleServiceContract;
use Core\Exceptions\InvalidOrderException;

class RoleController extends Controller
{
    protected $roleSV;
	public function __construct(RoleServiceContract $roleSV)
	{
		$this->roleSV = $roleSV;
	}
    public function rolesList(Request $request)
    {
        $result = $this->roleSV->getRolesList($request->all());
        return response()->json($result);
    }
}