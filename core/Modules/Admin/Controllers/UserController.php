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

	public function store(Request $request)
	{
		if($request->ajax()){
			try{
				$this->userSV->storeUser($request->all());
			}catch(InvalidOrderException $except){
				return response()->json([
					'status' => false,
					'messages' => $except->getMessages()
				]);
			}
			return response()->json([
				'status' => true,
				'messages' => 'Successful!',
			]);
		}
	}
}
