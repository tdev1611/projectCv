<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\UserService;


class UserController extends Controller
{
    protected $userService;
    function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    function register() {
        
    }



    
}
