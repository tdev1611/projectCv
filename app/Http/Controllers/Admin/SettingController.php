<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    protected  $setting;
    function __construct(SettingWeb $setting)
    {
        $this->setting = $setting;
    }

    function create()
    {
        $setting = $this->setting->first();
        return view('admin.setting-web.add', compact('setting'));
    }


    function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = $this->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $request->hasFile('image') ? $data['image'] = $this
                ->handleUploadedImage($request->file('image'), 'setting') : null;
            $this->setting->create($data);
            return back()->with('success', 'Create successfully');
        } catch (\Exception $e) {
            return back()->withErrors($validator)->with('error', $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token');
        try {
            $validator = $this->validateStore($data);
            $request->hasFile('image') ? $data['image'] = $this
                ->handleUploadedImage($request->file('image'), 'setting') : null;
            $update = $this->setting->where('id', $id)->update($data);
            $message = 'Update successfully! ';

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->withErrors($validator)->with('error', $e->getMessage())->withInput();
        }
    }




    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'content' => 'required',
            'desc' => 'nullable',
            'image' => 'nullable',
            'status' => 'in:1,2',

        ]);

        return $validator;
    }

    function handleUploadedImage($image, $slug)
    {
        $filename = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/uploads/setting', $filename);
        return "public/uploads/setting/" . $filename;
    }
}
