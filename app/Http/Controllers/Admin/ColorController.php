<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Admin\ColorService;

class ColorController extends Controller
{

    protected $color;
    function __construct(ColorService $colorService)
    {
        $this->color = $colorService;
    }

    public function index()
    {
        $colors = $this->color->getAll();
        return view('admin.colors.index', compact('colors'));
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
            $validator = $this->color->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $this->color->store($data);

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
        $color = $this->color->find($id);
        $colors = $this->color->getAll();
        return view('admin.colors.edit', compact('color', 'colors'));
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
            $validator = $this->color->validateUpdate($id, $data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $this->color->update($id, $data);

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
            $color = $this->color->find($id);
            $color->delete();
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
