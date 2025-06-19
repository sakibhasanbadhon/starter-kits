<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $this->updateInfo($user);
        return redirect()->intended(route('admin.dashboard'))->with(['success' => ['Congrs, You Are logged In']]);
    }

    protected function updateInfo($admin) {
        try{
            $admin->update([
                'last_logged_in'    => now(),
                'login_status'      => true,
            ]);
        }catch(Exception $e) {
            // handle error
        }
    }

}
