<?php

namespace App\Services\Admin;


use Illuminate\Support\Facades\Validator;
use App\Models\CodeDiscount;



class DiscountService
{
    protected $discount;

    function __construct(CodeDiscount $discount)
    {
        $this->discount = $discount;
    }

    function getAll()
    {
        return $this->discount->oldest('code')->get();
    }
    function find($id)
    {
        $discount =  $this->discount->find($id);
        if ($discount === null) {
            throw new \Exception('Not found discount ');
        }
        return $discount;
    }

    // validate uopdate
    function validateDiscount($data)
    {
        $validator = Validator::make(
            $data,
            [
                'code' => 'required|max:250|unique:code_discounts,code,',
                'amount' => 'required|numeric',
                'note' => 'nullable|string',
                'status' => 'in:1,2',
            ],

        );
        return $validator;
    }
    function checkValidateDiscount($data)
    {
        $validator = $this->validateDiscount($data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }

    //creatre

    function store($data)
    {
        return $this->discount->create($data);
    }



    // update
    function validateUpdate($id, $data)
    {
        $validator = Validator::make($data, [
            'code' => 'required|max:70|unique:code_discounts,code,' . $id,
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'status' => 'in:1,2',

        ]);
        return $validator;
    }
    function checkValidateUpdate($id, $data)
    {
        $validator = $this->validateUpdate($id, $data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }


    function update($id, $data)
    {
        $size = $this->find($id);
        $size->update($data);
        return $size;
    }
}
