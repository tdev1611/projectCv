<?php

namespace App\Services\Client;


use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\ShippingAddress;


class ProfileService
{
    protected $user;
    protected $ship;
    function __construct(User $user, ShippingAddress $ship)
    {
        $this->user = $user;
        $this->ship = $ship;
    }

    // validate uopdate
    function validateUser($data)
    {
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|string|max:50',
                'password' => 'required|min:6|string',

            ],
        );
        return $validator;
    }
    function checkValidateUser($data)
    {
        $validator = $this->validateUser($data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }
    function updateUser($data, $id)
    {
        return   $this->user->where('id', $id)->update($data);
    }

    //shippin address

    //get first
    function getShippinAddress()
    {
        return $this->ship->first();
    }

    function validateShipping($data)
    {
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email',
                'phone' => 'required|numeric|digits_between:10,11',
                'province' => 'required',
                'address' => 'required|string',
                'note' => 'nullable|string',
            ],
        );
        return $validator;
    }
    function checkValidateShipping($data)
    {
        $validator = $this->validateShipping($data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }

    function createShipping($data)
    {
        return $this->ship->create($data);
    }
    function updateShipping($data, $id)
    {
        return   $this->ship->where('user_id', $id)->update($data);
    }
}
