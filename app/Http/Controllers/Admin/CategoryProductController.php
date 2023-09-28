<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;

class CategoryProductController extends Controller
{
    //
    private $categoryService;

    function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    function index()
    {
        $categories = $this->categoryService->getAll();

        return view('admin.category_product.index', compact('categories'));
    }

    function store(Request $request)
    {
        $data = $request->all();
        try {
            $validator   = $this->categoryService->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $this->categoryService->store($data);


            $res = [
                'success' => true,
                'message' => "Created category Successfully"
            ];
            return response()->json($res);
        } catch (\Exception $e) {
            $res = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($res);
        }
    }


    function create()
    {
        return abort(404);
    }


    function delete($id)
    {
        try {
            $color = $this->categoryService->find($id);
            $color->delete();
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
