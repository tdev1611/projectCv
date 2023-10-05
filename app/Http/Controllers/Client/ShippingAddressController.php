<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Client\ProfileService;

class ShippingAddressController extends Controller
{
    //

    protected $profileService;
    function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    function index()
    {
        $address = $this->profileService->getShippinAddress();
        return view('client.personal.shipping-address', compact('address'));
    }


    function store(Request $request)
    {
        $data = $request->all();
        try {
            $this->profileService->checkValidateShipping($data);
            $data['user_id'] = auth()->user()->id;
            $this->profileService->createShipping($data);

            return response()->json([
                'success' => true,
                'message' => 'Create Shipping Address Success'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    function update(Request $request)
    {

        $data = $request->all();
        try {
            $this->profileService->checkValidateShipping($data);
            $user_id = auth()->user()->id;
            $data['user_id'] = $user_id;
            $this->profileService->updateShipping($data, $user_id);

            return response()->json([
                'success' => true,
                'message' => 'Update Shipping Address Success'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
