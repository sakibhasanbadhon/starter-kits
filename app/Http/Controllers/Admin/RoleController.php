<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use Illuminate\Support\Str;
use App\Models\Admin\Module;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Helpers\JsonResponse;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Role index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index(){
        Gate::authorize('access-role');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), "Roles" => ''];
        $this->setPageTitle('Roles');
        $roles = Role::with('permissions')->paginate(15);
        return view('admin.sections.roles.index', compact('breadcrumb','roles'));
    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function create(){
        Gate::authorize('create-role');
        $this->setPageTitle('Create Role');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), "Roles" => route('admin.manage-admins.roles.index'), "Add" => ''];
        $modules = Module::with('permissions')->latest()->get();
        return view('admin.sections.roles.form', compact('breadcrumb', 'modules'));
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */

    public function store(RoleRequest $request){

        Gate::authorize('create-role');
        $this->roleService->storeOrUpdateData($request);
        $message = ['Role has been saved successfull.'];
        return redirect()->route('admin.manage-admins.roles.index')->with(['success' => $message]);
    }

    /**
     * Role cedit
     *
     * @method GET
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */

     public function edit($id){

        Gate::authorize('edit-role');

        $this->setPageTitle('Edit Role');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), "Roles" => route('admin.manage-admins.roles.index') , "Edit Role" => ''];

        $role = Role::with('permissions')->findOrFail($id);
        $modules = Module::with('permissions')->latest()->get();

        return view('admin.sections.roles.form', compact('breadcrumb','modules','role'));
    }


     /**
     * Role Delete
     *
     * @method DELETE
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function delete(Request $request){

        Gate::authorize('delete-role');

        $validator = Validator::make($request->all(),[
            'target' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            $role = Role::with('permissions')->find($validated['target']);

            if($role->delatable == true){
                $role->permissions()->detach();
                $role->delete();
            }else{
                return back()->with(['error' => ['Can\'t Delete Default Role']]);
            }
        } catch (\Exception $th) {
            return back()->with(['error' => ['Something Went Wrong, Please Try Again']]);
        }

        return redirect()->route('admin.manage-admins.roles.index')->with(['success' => ['Role Deleted Successful']]);
    }


    public function search(Request $request){
        if($request->ajax()){
            $roles = Role::search($request->text)->limit(15)->get();
            $returnHTML = view('admin.includes.search.roles-table', compact('roles'))->render();
            return JsonResponse::success(['success' => ['Roles Search Successfully!']], $returnHTML);
        }
    }
}
