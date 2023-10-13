<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IpAddress;

class IpController extends Controller
{

    function index()
    {

        $ips =   IpAddress::latest()->with('user')->get();
        return view('admin.ip-address.index', compact('ips'));
    }
}
