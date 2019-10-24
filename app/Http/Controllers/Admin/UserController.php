<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\YodleeAccount;

class UserController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | user Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles all dashboard related functionalities.
      | In this controller we fetch information regarding number of users, and QC.
      |
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $users = User::userList($request);
           // print_r($users->get()); exit;
            return DataTables::of($users)
                            ->addColumn('action', function ($users) {
                                return (string) view('admin.user.partials._list', ['user' => $users]);
                            })
                            ->editColumn('is_active', function ($users) {
                                return view('admin.user.partials._list', ['user' => $users, 'status' => true]);
                            })
                            ->rawColumns(['action', 'is_active'])
                            ->make(true);
        }
       // die('hell');
        return view('admin.user.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        User::updateStatus($request->all(), $id);
        return response()->json(true);
    }
    
     /**
     * view the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        $html = view('user/partials._modal', compact('user'))->render();
        return response()->json(['html' => $html]);
    }

    public function yodleeResponse(Request $request) {
        $params = json_decode($request->JSONcallBackStatus, true);
        $data = $params[0];
        $data['user_id'] = $request->user_id;

        if($data['status'] == 'SUCCESS') {
            YodleeAccount::saveData($data);
        }

        return view('yodlee', ['data' => $data]);
    }

}
