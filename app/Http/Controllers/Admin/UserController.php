<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    protected  $user;
    function __construct(UserService $userService)
    {
        $this->user = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users =  $this->user->getAll();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user =  $this->user->find($id);
        return view('admin.users.edit', compact('user'));
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
            $data = $request->only('name', 'role', 'status');
            $this->user->checkValidateUpdate($data, $id);

            $this->user->update($data, $id);

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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $this->user->delete($id);

            return response()->json([
                'success' => true,
                'message' => ' deleted successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => true,
                'message' => $exception
            ]);
        }
    }


    // action
    function action(Request $request)
    {
        $list_check = $request->list_check;
        $status = $request->status;
        $role = $request->role;
        $reset_users = $request->reset_users;
        $delete_users = $request->delete_users;
        $reset_users = $request->reset_users;

        try {
            if (empty($list_check)) {
                throw new \Exception('You must choose a member ');
            }
            if (empty($status || $delete_users || $role || $reset_users)) {
                throw new \Exception('You must choose a action ');
            }

            foreach ($list_check as $id) {
                $user = $this->user->find($id);
                if (!$user) {
                    continue;
                }

                $status ? $user->status = $status : null;
                $role ? $user->role = $role : null;
                $user->save();

                $delete_users ? $user->delete() : null;
                $reset_users ? $this->user->resetUser($user) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Update member Successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
