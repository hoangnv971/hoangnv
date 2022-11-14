<?php

namespace Core\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Models\User;
class UserController extends Controller
{

	public function index(Request $request)
	{
		if($request->post()){
		}
		return view('Admin::user.index');
	}
}
