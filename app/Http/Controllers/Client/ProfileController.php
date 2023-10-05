<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\ProfileService;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    
    protected $profileService;
    function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    function index()
    {
        return view('client.personal.index');
    }


    function update(Request $request)
    {
        $data = $request->only('name', 'password');
        try {
            $this->profileService->checkValidateUser($data);
            $user = auth()->user();
            // update password
            $data['password'] = ($request->password != 'defaultacbc') ?
                Hash::make($request->password) : $user->password;

            $this->profileService->updateUser($data, $user->id);
            return response()->json([
                'message' => 'Profile updated successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ]);
        }
    }
}
