<?php

namespace Core\Modules\Admin\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;
class SidebarComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function render()
    {
        $routes = Route::getRoutes();
        $routeActive = Route::getCurrentRoute()->getName();
        $sidebar = [
            'admin.dashboard' => [
                'icon' => '<i class="nav-icon fas fa-tree"></i>',
                'name' => 'Trang chủ',
                'class' => '',
                'childs' => [
                ]
            ],
            'admin.user.index' => [
                'icon' => '<i class="nav-icon fa-solid fa-user"></i>',
                'name' => 'Quản lý người dùng',
                'class' => '',
                'childs' => [
                ]
            ]

        ];
        return view('Admin::layouts.sidebar', compact('sidebar', 'routes', 'routeActive'));
    }
}
