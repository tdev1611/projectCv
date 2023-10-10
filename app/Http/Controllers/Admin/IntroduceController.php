<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Introduce;
use Illuminate\Support\Facades\Validator;

class IntroduceController extends Controller
{
    protected  $introduce;
    function __construct(Introduce $introduce)
    {
        $this->introduce = $introduce;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    function create()
    {
        $introduce = $this->introduce->first();
        return view('admin.introduce.add', compact('introduce'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            // validate
            $this->validateStore($data);

            $data['user_id'] = auth()->user()->id;
            $this->introduce->create($data);

            $response = [
                'success' => true,
                'message' => 'Created Successfully'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response =  [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token');
        // $data = $request->all();
        try {
            $validator = $this->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $data['user_id'] = auth()->user()->id;
            $this->introduce->where('id', $id)->update($data);

            $response = [
                'success' => true,
                'message' => 'Updated Successfully'
            ];
        } catch (\Exception $e) {
            $response =  [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }

    function validateStore($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'content' => 'required',
            'status' => 'in:1,2',

        ]);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }
}
