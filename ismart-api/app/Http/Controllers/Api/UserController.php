<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Resources\User as UserApi;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        //

        $users = User::paginate(5);
        $arr = [
            'success'=> true,
            'message' => "Danh sách users",
            'data'=> $users
        ];
        return response()->json($arr,200);
    }


    public function store(Request $request)
    {
        //
      
        $input = $request->all();
        $validate = Validator::make($input, [
            'name' => 'required'

        ]);
        if ($validate->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validate->errors()
            ];
            return response()->json($arr, 200);
        }
        $user = User::create($input);
        $arr = [
            'status' => true,
            'message' => "Sản phẩm đã lưu thành công",
            'data' => new UserApi($user)
        ];
        return response()->json($arr, 201);

    }

    public function show($id)
    {
        //
        return $id;
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}