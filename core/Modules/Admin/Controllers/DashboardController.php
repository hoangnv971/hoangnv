<?php

namespace Core\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	public function index()
	{
		return view('Admin::layout');
	}
}
