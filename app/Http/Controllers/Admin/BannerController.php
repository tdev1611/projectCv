<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Admin\BannerService;

class BannerController extends Controller
{
    protected $bannerService;
    function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    function index()
    {
        $banners = $this->bannerService->getAll();
        return view('admin.banner.index', compact('banners'));
    }
    function create()
    {

        return view('admin.banner.add');
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $this->bannerService->checkValidateStore($data);

            // handle uploadImg
            $request->hasFile('image') ? $data['image'] = $this->bannerService
                ->handleUploadedImage($request->file('image'), 'banner') : null;

            // create
            $this->bannerService->store($data);

            return back()->with('success', 'create Success');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function delete($id)
    {
        try {
            $this->bannerService->delete($id);
            $mess = 'Xóa  thành công';
            return redirect()->back()->with('success', $mess);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
