<?php

namespace Core\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Models\User;
use Core\Services\Contracts\UserServiceContract;
class UserController extends Controller
{
	protected $userSV;
	public function __construct(UserServiceContract $userSV)
	{
		$this->userSV = $userSV;
	}

	public function index(Request $request)
	{

		if($request->ajax()){
			return response()->json([
				'data' => $this->userSV->dataTable($request)
			]);
		}
		return view('Admin::user.index');
	}
}
