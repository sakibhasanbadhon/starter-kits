<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard(){
        // authorized
        Gate::authorize('access-dashboard');

        $this->setPageTitle('Dashboard');
        $breadcrumb = ['Dashboard' => ''];
        return view('dashboard', compact('breadcrumb'));
    }

    /**
     * Logout method
     *
     * @return Illuminate\Http\Request
     * @method POST
     */
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('admin.login')->with('success','Logout Successfully!');
    }
}
