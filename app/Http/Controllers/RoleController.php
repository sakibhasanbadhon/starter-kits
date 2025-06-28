<?php

namespace App\Http\Controllers;

use App\Models\Admin\Role;
use App\Models\Admin\Module;
use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    use ResponseData;

    protected $role;

    public function __construct(RoleService $roleService)
    {
        $this->role = $roleService;
    }

    /**
     * Role index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index(Request $request){
        if($request->ajax()){
            return $this->role->allData($request);
        }

        // authorized 403
        Gate::authorize('access-role');

        $breadcrumb = ["Role List" => ''];
        $this->setPageTitle('Role List');
        return view('roles.index', compact('breadcrumb'));
    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function create(){
        // authorized 403
        Gate::authorize('create-role');

        $this->setPageTitle('Create Role');
        $breadcrumb = ["Role List" => route('admin.roles.index'), "Create" => ''];
        $modules = Module::with('permissions')->latest()->get();
        return view('roles.form', compact('breadcrumb', 'modules'));
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */

    public function storeOrUpdate(RoleRequest $request){
        // authorized 403
        Gate::authorize('create-role');

        $result = $this->role->storeOrUpdateData($request);
        if($result){
            if($request->update_id){
                return redirect()->route('admin.roles.index')->with('success','Role updated successfull.');
            }else{
                return redirect()->route('admin.roles.index')->with('success','Role saved successfull.');
            }
        }else{
            return redirect()->back()->with('error','Role cannot be created!');
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
        Gate::authorize('edit-role');

        $data['role'] = Role::with('permissions')->findOrFail($id);
        $data['modules'] = Module::with('permissions')->latest()->get();

        $this->setPageTitle('Edit Role');
        $data['breadcrumb'] = ["Role List" => route('admin.roles.index') , "Edit Role" => ''];
        return view('roles.form', $data);
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
            if(permission('delete-role')){
                return $this->role->deleteData($request->id);
            }else{
                return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }


}



