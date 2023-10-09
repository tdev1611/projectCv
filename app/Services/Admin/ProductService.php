<?php

namespace App\Services\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductService
{

    protected $product;
    function __construct(Product $product)
    {
        $this->product = $product;
    }

    function getAll()
    {
        return $this->product->oldest()->with('category', 'colors', 'sizes')->get();
    }
    // CRUD
    // validate store



    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:250|unique:products,name,',
            'slug' => 'required|max:250|unique:products,slug,',
            'code' => 'unique:products,code,',
            'qty' => 'required|numeric',
            'category_product_id' => 'required|exists:category_products,id',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|between:0,100',
            'desc' => 'required',
            'detail' => 'required',
            'images' => 'required',
            'list_image' => 'required|array',
            'status' => 'in:1,2',
            'features' => 'in:1,2',
            'colors' => 'required|exists:colors,id',
            'sizes' => 'required|exists:sizes,id',

        ]);
        return $validator;
    }
    function handleUploadedImage($image, $slug)
    {
        $filename = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/uploads/products', $filename);
        return "public/uploads/products/" . $filename;
    }

    // listImgs 
    function handleUpLoadListImages($images, $slug)
    {
        $list_images = [];
        foreach ($images as $file) {
            $filename = uniqid() . '-' . $slug . '.' . strtolower($file->getClientOriginalExtension());
            $path = $file->move('public/uploads/products/list_image', $filename);
            $list_images[] = "public/uploads/products/list_image/" . $filename;
        }
        return json_encode($list_images);
    }

    function store($data)
    {
        return $this->product->create($data);
    }
    function attach($product)
    {
        $product->colors()->attach(request()->colors);
        $product->sizes()->attach(request()->sizes);
    }


    function find($id)
    {
        $product =  $this->product->with('category', 'colors', 'sizes')->find($id);
        if ($product === null) {
            throw new \Exception('Not found product ');
        }
        return $product;
    }

    // update
    function validateUpdate($id, $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:70|unique:products,name,' . $id,
            'slug' => 'required|max:250|unique:products,slug,' . $id,
            'category_product_id' => 'required|exists:category_products,id',
            'price' => 'required|numeric',
            'qty' => 'required|numeric',
            'discount' => 'nullable|numeric|between:0,100',
            'desc' => 'required',
            'detail' => 'required',
            'list_image' => 'nullable|array',
            'status' => 'in:1,2',
            'features' => 'in:1,2',
            'colors' => 'required|exists:colors,id',
            'sizes' => 'required|exists:sizes,id',

        ]);
        return $validator;
    }

    function UpdateImage($id, $newImage, $slug)
    {
        if (!empty($newImage)) {
            $img_old = $this->find($id)->images;
            unlink($img_old);
        }
        $filename = $slug . '-' . time() . '.' . strtolower($newImage->getClientOriginalExtension());
        $path = $newImage->move('public/uploads/products', $filename);
        return $img = "public/uploads/products/" . $filename;
    }

    // updateListImages
    function updateListImages($id, $newListImages, $slug)
    {
        $list_images = [];
        if (!empty($newListImages)) {
            $list_imgOld = json_decode($this->find($id)->list_image, true);
            foreach ($list_imgOld as $imgOld) {
                if (File::exists($imgOld)) {
                    File::delete($imgOld);
                }
            }
        }
        foreach ($newListImages as $image) {
            $filename = uniqid() . '-' . $slug . '.' . strtolower($image->getClientOriginalExtension());
            $path = $image->move('public/uploads/products/list_image', $filename);
            $list_images[] = "public/uploads/products/list_image/" . $filename;
        }
        return json_encode($list_images);
    }
    function update($id, $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }
    // sync

    function sync($product)
    {
        $product->colors()->sync(request()->colors);
        $product->sizes()->sync(request()->sizes);
    }


    // deltee
    function delete($id)
    {
        $product = $this->find($id);
        $img_old = $product->images;
        unlink($img_old);
        return $product->delete();
    }
}
