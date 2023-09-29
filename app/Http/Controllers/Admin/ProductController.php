<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use App\Services\Admin\SizeService;
use App\Services\Admin\ColorService;


class ProductController extends Controller
{
    protected $productService;
    protected $sizeService;
    protected $colorService;
    function __construct(ProductService $productService, SizeService $sizeService, ColorService $colorService)
    {
        $this->productService = $productService;
        $this->sizeService = $sizeService;
        $this->colorService = $colorService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        return view('admin.products.add');
    }


    public function store(Request $request)
    {

        $data = $request->all();
        try {
            $validator = $this->productService->validateStore($data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            // code
            $data['code'] =  'H-' . random_int(10000, 999999);
            // handle uploadImg
            $request->hasFile('images') ? $data['images'] = $this->productService
                ->handleUploadedImage($request->file('images'), $request->slug) : null;
            // list imgs 
            $request->hasFile('list_image') ? $data['list_image'] = $this->productService
                ->handleUpLoadListImages($request->file('list_image'), $request->slug) : null;
            // create
            $product = $this->productService->store($data);
            //attach
            $this->productService->attach($product);
            return back()->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withErrors($validator)->with('error', $e->getMessage())->withInput();
        }
    }



    public function edit($id)
    {
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        $product = $this->productService->find($id);
        $colorIds = $product->colors->pluck('id')->toArray();
        $sizeIds  = $product->sizes->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'colors', 'sizes', 'colorIds', 'sizeIds'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            $validator = $this->productService->validateUpdate($id, $data);
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            // handle uploadImg
            $request->hasFile('images') ? $data['images'] = $this->productService
                ->UpdateImage($id, $request->file('images'), $request->slug) : null;
            // list imgs 
            $request->hasFile('list_image') ? $data['list_image'] = $this->productService
                ->updateListImages($id, $request->file('list_image'), $request->slug) : null;
            // create
            $product = $this->productService->update($id, $data);

            //sync
            $this->productService->sync($product);

            return redirect(route('admin.products.index'))->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withErrors($validator)->with('error', $e->getMessage())->withInput();
        }
    }


    function delete($id)
    {
        try {
            $product = $this->productService->find($id);
            $product->delete();
            return back()->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
