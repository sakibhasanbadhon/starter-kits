<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\User;
use App\Http\Helpers\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    public function index(){
        Gate::authorize('access-role');
        $this->setPageTitle('User Manage');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Users' => ''];
        $users = User::paginate(15);
        return view('admin.sections.users.index',compact('breadcrumb','users'));
    }

    public function userDetails($id){
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Users' => ''];
        return view('admin.sections.users.details',compact('breadcrumb'));
    }

    public function search(Request $request){
        if($request->ajax()){
            $users = User::search($request->text)->limit(15)->get();
            $returnHTML = view('admin.includes.search.user-table', compact('users'))->render();
            return JsonResponse::success(['success' => ['Admin Search Successfully!']], $returnHTML);
        }
    }
}
