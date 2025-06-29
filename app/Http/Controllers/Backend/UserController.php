<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin\Role;
use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    use ResponseData;

    protected $user;

    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    /**
     * User index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index(Request $request){
        if($request->ajax()){
            return $this->user->allData($request);
        }

        // authorized 403
        Gate::authorize('access-admin');

        $breadcrumb = ["User List" => ''];
        $this->setPageTitle('User List');
        return view('backend.user.index', compact('breadcrumb'));
    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function create(){
        // authorized 403
        Gate::authorize('create-admin');

        $this->setPageTitle('New User');
        $data['breadcrumb'] = ["User List" => route('admin.users.index'), "New User" => ''];
        return view('backend.user.form', $data);
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function storeOrUpdate(UserRequest $request){
        // authorized 403
        Gate::authorize('create-admin');

        $result = $this->user->storeOrUpdateData($request);

        if($result){
            if($request->update_id){
                return redirect()->route('admin.users.index')->with('success','User updated successfull.');
            }else{
                return redirect()->route('admin.users.index')->with('success','User saved successfull.');
            }
        }else{
            return redirect()->back()->with('error','User cannot be created!');
        }
    }

    /**
     * Role cedit
     *
     * @method GET
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
     public function edit(int $id){
        // authorized 403
        Gate::authorize('edit-admin');

        $data['edit'] = User::findOrFail($id);

        $this->setPageTitle('Edit User');
        $data['breadcrumb'] = ["Edit User" => route('admin.users.index') , "Edit User" => ''];
        return view('backend.user.form', $data);
    }

    /**
     * Admin Status
     *
     * @method DELETE
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function statusChange(Request $request){
        if($request->ajax()){
            if(permission('delete-admin')){
                return $this->user->statusData($request->id,$request->status);
            }else{
                return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }

    /**
     * Role Delete
     *
     * @method DELETE
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function delete(Request $request){
        if($request->ajax()){
            if(permission('delete-admin')){
                return $this->user->deleteData($request->id);
            }else{
                return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }
}
