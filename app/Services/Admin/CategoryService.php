<?php

namespace App\Services\Admin;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Validator;

class CategoryService
{

    protected $category;
    function __construct(CategoryProduct $category)
    {
        $this->category = $category;
    }

    function getAll()
    {
        return $this->category->oldest('prioty')->get();
    }
    // CRUD
    // validate store
    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:250|unique:category_products,name,',
            'slug' => 'required|max:250|unique:category_products,slug,',
            'cat_parent' => 'nullable|exists:category_products,id',
            'status' => 'in:1,2',

        ]);
        return $validator;
    }

    function store($data)
    {
        return $this->category->create($data);
    }


    function find($id)
    {
        $category =  $this->category->find($id);
        if ($category === null) {
            throw new \Exception('Not found category ');
        }
        return $category;
    }

    // update
    function validateUpdate($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:70|unique:categorys,name,' . $id,
            'status' => 'in:1,2',

        ]);
        return $validator;
    }
    function update($id, $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }


    // deltee
    function delete($id)
    {
        $category = $this->find($id);
        $ids =  $category->children->pluck('id')->toArray();
        $category->whereIn('id', $ids)->delete();
        $category->delete();
    }
}
