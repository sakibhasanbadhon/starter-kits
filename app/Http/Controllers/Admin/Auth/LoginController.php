<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $page_title = __('Login');
        return view('admin.auth.login', compact('page_title'));
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

     /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->status == 2)
        {
            $this->guard()->logout();
            return back()->with('error','Your account is disabled. Please contact with admin.');
        }else{
            $role_id = Auth::guard('admin')->user()->role_id;

            $role = Role::where('id',$role_id)->first();
            $permissions = $role->permissions;

            $permission = [];
            if(!empty($permissions))
            {
                foreach ($permissions as $value) {
                    array_push($permission,$value->slug);
                }

                Session::put('permission',$permission);
            }
        }

        $this->updateInfo($user);
        return redirect()->intended(route('admin.dashboard'))->with('success','Congrs, You Are logged In');
    }

    protected function updateInfo($admin) {
        try{
            $admin->update([
                'last_logged_in' => now(),
                'login_status'   => true,
            ]);
        } catch(Exception $e) {

        }
    }

}
