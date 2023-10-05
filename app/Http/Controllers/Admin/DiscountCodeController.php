<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Admin\DiscountService;

class DiscountCodeController extends Controller
{
    private $discountService;
    function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function index()
    {
        $codes = $this->discountService->getAll();
        return view('admin.discount_code.index', compact('codes'));
    }


    public function create()
    {

        return view('admin.discount_code.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $this->discountService->checkValidateDiscount($data);
            $this->discountService->store($data);

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
        $code = $this->discountService->find($id);

        return view('admin.discount_code.edit', compact('code'));
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
            $validator = $this->discountService->checkValidateUpdate($id, $data);

            $this->discountService->update($id, $data);

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
            $size = $this->discountService->find($id);
            $size->delete();
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
