<?php

namespace App\Services\Admin;

use App\Models\Color;
use Illuminate\Support\Facades\Validator;

class ColorService
{

    protected $color;
    function __construct(Color $color)
    {
        $this->color = $color;
    }

    function getAll()
    {
        return $this->color->oldest()->get();
    }
    // CRUD
    // validate store
    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:250|unique:colors,name,',
            'status' => 'in:1,2',

        ]);
        return $validator;
    }

    function store($data)
    {
        return $this->color->create($data);
    }


    function find($id)
    {
        $color =  $this->color->find($id);
        if ($color === null) {
            throw new \Exception('Not found color ');
        }
        return $color;
    }

    // update
    function validateUpdate($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:70|unique:colors,name,' . $id,
            'status' => 'in:1,2',

        ]);
        return $validator;
    }
    function update($id, $data)
    {
        $color = $this->find($id);
        $color->update($data);
        return $color;
    }


    // deltee
    function delete($id)
    {
        $color = $this->find($id);
        $img_old = $color->image;
        unlink($img_old);
        return $color->delete();
    }
}
