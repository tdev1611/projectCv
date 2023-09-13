<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{

    protected $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }

    




}
