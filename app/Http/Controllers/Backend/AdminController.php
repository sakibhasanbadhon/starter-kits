<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin\Role;
use App\Models\Admin\Admin;
use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    use ResponseData;

    protected $admin;

    public function __construct(AdminService $adminService)
    {
        $this->admin = $adminService;
    }

    /**
     * Admin index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index(Request $request){
        if($request->ajax()){
            return $this->admin->allData($request);
        }

        // authorized 403
        Gate::authorize('access-admin');

        $breadcrumb = ["Admin List" => ''];
        $this->setPageTitle('Admin List');
        return view('backend.admin.index', compact('breadcrumb'));
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

        $this->setPageTitle('Create Admin');
        $data['breadcrumb'] = ["Admin List" => route('admin.admins.index'), "Create" => ''];
        $data['roles'] = Role::latest()->get();
        return view('backend.admin.form', $data);
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function storeOrUpdate(AdminRequest $request){
        // authorized 403
        Gate::authorize('create-admin');

        $result = $this->admin->storeOrUpdateData($request);
        // dd($result);
        if($result){
            if($request->update_id){
                return redirect()->route('admin.admins.index')->with('success','Admin updated successfull.');
            }else{
                return redirect()->route('admin.admins.index')->with('success','Admin saved successfull.');
            }
        }else{
            return redirect()->back()->with('error','Admin cannot be created!');
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

        $data['edit'] = Admin::findOrFail($id);

        $this->setPageTitle('Edit Admin');
        $data['breadcrumb'] = ["Edit Admin" => route('admin.admins.index') , "Edit Admin" => ''];
        $data['roles'] = Role::latest()->get();
        return view('backend.admin.form', $data);
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
                return $this->admin->statusData($request->id,$request->status);
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
                return $this->admin->deleteData($request->id);
            }else{
                return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }
}
