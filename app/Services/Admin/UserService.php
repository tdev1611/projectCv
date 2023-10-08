<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Rules\InviteCodeMatch;

class UserService
{

    protected $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }


    function getAll()
    {
        return $this->user->all();
    }
    function find($id)
    {
        $user = $this->user->find($id);
        if ($user === null) {
            throw new \Exception('not found user');
        }
        return $user;
    }
    // CREATE

    function validateUpdate($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'nullable|max:250|unique:users,email,' . $id,
            'phone' => 'nullable|max:250|unique:users,phone,' . $id,
            'referrer_code' => ['nullable', 'numeric', new InviteCodeMatch],
            'role' => 'in:1,2',
            'status' => 'in:1,2',
        ]);
        return $validator;
    }
    function checkValidateUpdate($data, $id)
    {
        $validator = $this->validateUpdate($data, $id);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }

    function update($data, $id)
    {

        return  User::where('id', $id)->update($data);
    }

    function delete($id)
    {
        return  $this->find($id)->delete();
    }


    // action
    function resetUser(User $user)
    {
      
        $user->status = 1;
        $user->role = 1;
        $user->address()->delete();
        $user->items()->delete();
        $user->save();
    }
}
