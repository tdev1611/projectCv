<?php

namespace App\Services\Admin;

use App\Models\Banner;
use Illuminate\Support\Facades\Validator;

class BannerService
{

    protected $banner;
    function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    function getAll()
    {
        return $this->banner->oldest('prioty')->get();
    }

    // CRUD
    // validate store
    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'image' => 'required',
            'prioty' => 'required',
            'status' => 'in:1,2'
        ]);
        return $validator;
    }

    function checkValidateStore($data)
    {
        $validator = $this->validateStore($data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }

    function handleUploadedImage($image, $slug)
    {
        $filename = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/uploads/banners', $filename);
        return "public/uploads/banners/" . $filename;
    }
    function store($data)
    {
        return $this->banner->create($data);
    }

    function find($id)
    {
        $banner =  $this->banner->find($id);
        if (!$banner) {
            throw new \Exception('Not found banner ');
        }
        return $banner;
    }

    // update
    function validateUpdate($id, $data)
    {
        $validator = Validator::make($data, [
            'banner_id' => 'required|exists:banners,id',
            'image' => 'image'
        ]);
        return $validator;
    }
    function update($id, $data)
    {
        $banner = $this->find($id);
        $banner->update($data);
        return $banner;
    }

    function UpdateImage($id, $newImage, $slug)
    {
        if (!empty($newImage)) {
            $img_old = $this->find($id)->image;
            unlink($img_old);
        }
        $filename = $slug . '-' . time() . '.' . strtolower($newImage->getClientOriginalExtension());
        $path = $newImage->move('public/uploads/banners', $filename);
        return $img = "public/uploads/banners/" . $filename;
    }


    // deltee
    function delete($id)
    {
        $banner = $this->find($id);
        $img_old = $banner->image;
        unlink($img_old);
        return $banner->delete();
    }
}
