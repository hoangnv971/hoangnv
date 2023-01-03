<?php

namespace Core\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Models\User;
use Core\Services\Contracts\UserServiceContract;
use Core\Exceptions\InvalidOrderException;

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
			$response = $this->userSV->dataTable($request);
			return response()->json($response);
		}
		return view('Admin::user.index');
	}

	public function create(Request $request)
	{
	}

	public function store(Request $request)
	{
		if($request->ajax()){
			$result = $this->userSV->storeUser($request->all());
			return response()->json($result);
		}
	}

	public function show(Request $request)
	{

	}

	public function edit(Request $request)
	{
	}

	public function update(Request $request)
	{
		# code...
	}

	public function destroy(Request $request)
	{
		# code...
	}
}
