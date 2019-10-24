<?php

namespace App\Http\Controllers\Admin;

use App\Services\Contracts\UserContract;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles all dashboard related functionalities.
      | In this controller we fetch information regarding number of users, and QC.
      |
     */

    protected $user;

    /**
     * Create a new HomeController instance.
     *
     * @return void
     */
    public function __construct(UserContract $user) {
        $this->user = $user;
    }

    /**
     * Show the admin panel.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke() {
        $pannels = [];

        return view('dashboard.home', compact('pannels'));
    }
     public function index() {
        $pannels = [];

        return view('admin.dashboard.home', compact('pannels'));
    }
    /**
     * function is used to update user password to new one.
     * @param  $request
     * @return void
     */
    public function changePassword(ChangePasswordRequest $request) {
        if (!\Auth::validate(['email' => \Auth::user()->email, 'password' => $request->old_password])) {
            return Redirect::to('admin/password/change')->with('error', trans('passwords.invalid_old_password'));
        }
        if ($request->old_password == $request->password) {
            return Redirect::to('admin/password/change')->with('error', trans('passwords.used_password'));
        }
        $this->user->updatePassword($request->password, \Auth::user()->id);

        return Redirect::to('admin/password/change')->with('success', trans('site.password_changed'));
    }
}
