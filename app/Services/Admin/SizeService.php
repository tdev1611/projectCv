<?php

namespace App\Services\Admin;

use App\Models\Size;
use Illuminate\Support\Facades\Validator;

class SizeService
{

    protected $size;
    function __construct(Size $size)
    {
        $this->size = $size;
    }

    function getAll()
    {
        return $this->size->oldest()->get();
    }
    // CRUD
    // validate store
    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:250|unique:sizes,name,',
            'status' => 'in:1,2',

        ]);
        return $validator;
    }

    function store($data)
    {
        return $this->size->create($data);
    }


    function find($id)
    {
        $size =  $this->size->find($id);
        if ($size === null) {
            throw new \Exception('Not found size ');
        }
        return $size;
    }

    // update
    function validateUpdate($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:70|unique:sizes,name,' . $id,
            'status' => 'in:1,2',

        ]);
        return $validator;
    }
    function update($id, $data)
    {
        $size = $this->find($id);
        $size->update($data);
        return $size;
    }


    // deltee
    function delete($id)
    {
        $size = $this->find($id);
        return $size->delete();
    }
}
