<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    private $dashboardService;
    function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    function index()
    {
        $allUsers =    $this->dashboardService->totalUsers();
        $usersActive =    $this->dashboardService->getUsersActive();
        $usersInactive =    $this->dashboardService->getUsersInactive();
        $categories =    $this->dashboardService->getCategories();

        $orders =   $this->dashboardService->getOrders();


        $activeCode =    $this->dashboardService->getCodeDiscount();



        return view('admin.dashboard', compact('orders', 'allUsers', 'usersActive', 'usersInactive', 'activeCode', 'categories'));
    }
}
