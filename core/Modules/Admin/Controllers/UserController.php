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
			$result = $this->userSV->dataTable($request->all());

			return response()->json([
				'data' => $result['users'],
				'recordsTotal' => $result ['total'],
				'recordsFiltered'=> $result ['total']
			]);
		}
		return view('Admin::user.index');
	}
}
