<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notify;
use Illuminate\Support\Facades\Validator;

class NotifyController extends Controller
{
    protected  $notify;
    function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }

    function create()
    {
        $notify = $this->notify->first();
        return view('admin.notify.add', compact('notify'));
    }


    function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = $this->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $this->notify->create($data);
            return back()->with('success', 'Create successfully');
        } catch (\Exception $e) {
            return back()->withErrors($validator)->with('error', $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token');
        // $data = $request->all();
        try {
            $validator = $this->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $update = $this->notify->where('id', $id)->update($data);
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
            'status' => 'in:1,2',

        ]);
        return $validator;
    }
}
