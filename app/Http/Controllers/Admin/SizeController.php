<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    //

    protected $size;
    function __construct(SizeService $sizeService)
    {
        $this->size = $sizeService;
    }

    public function index()
    {
        $sizes = $this->size->getAll();
        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
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
            $validator = $this->size->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $this->size->store($data);

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


    public function edit($id)
    {
        $size = $this->size->find($id);
        $sizes = $this->size->getAll();
        return view('admin.sizes.edit', compact('size', 'sizes'));
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
        try {
            $data = $request->all();
            $validator = $this->size->validateUpdate($id, $data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $this->size->update($id, $data);

            $response = [
                'success' => true,
                'message' => 'Updated Successfully'
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


    public function delete($id)
    {

        try {
          $this->size->delete($id);
 
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
