<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Introduce;

class IntroduceController extends Controller
{
    function index(Introduce $introduce)
    {
        $introduce = $introduce->where('status', 1)->with('user')->first();
        return view('client.introduce.index', compact('introduce'));
    }
}
