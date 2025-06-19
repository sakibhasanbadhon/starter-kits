<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminManagementController extends Controller
{
    /**
     * Admin index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index()
    {
        Gate::authorize('access-admin');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Admins' => ''];
        $this->setPageTitle('Roles');
        $admins = Admin::with('role')->paginate(15);
        return view('admin.sections.admins.index', compact('breadcrumb', 'admins'));
    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function create()
    {
        Gate::authorize('create-admin');
        $this->setPageTitle('Create Admin');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Admins' => route('admin.manage-admins.index'), 'Create' => ''];
        $roles = Role::latest()->get();
        $form_type = 'create';

        return view('admin.sections.admins.form', compact('breadcrumb', 'roles','form_type'));
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        Gate::authorize('create-role');

        if($request->target){
            // come from edit request
            $email_validation = 'required|email|unique:admins,email,'.$request->target;
            $phone_validation = 'required|min:9|unique:admins,phone,'.$request->target;
            $password_validation = 'nullable';
            $confirm_password_validation = 'nullable';
            $role_validation = 'nullable';
        }else{
            // come from create request
            $email_validation = 'required|email|unique:admins,email';
            $phone_validation = 'required|min:9|unique:admins,phone';
            $password_validation = 'required|confirmed|min:6';
            $confirm_password_validation = 'required';
            $role_validation = 'required';
        }

        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:60|string',
            'last_name'             => 'required|max:60|string',
            'email'                 =>  $email_validation,
            'phone'                 => $phone_validation,
            'password'              => $password_validation,
            'password_confirmation' => $confirm_password_validation,
            'role'                  => $role_validation,
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            $image = uploadLocalImage($request->image, 'admin-profile', $request->old_image);
            $image_path = uploadImage([$image['dev_path']], 'admin-profile', $request->old_image);
            deleteFile($image['dev_path']);
            $validated['image'] = $image_path;
        }
        // if come from create form
        if(!$request->target){
            $validated['password'] = Hash::make($validated['password']);
            $validated['role_id'] = $validated['role'];
            $validated['status'] = true;
        }

        $validated['user_name'] = generateUsername($validated['first_name'],$validated['last_name'],"admins");


        try {
            Admin::updateOrCreate(['id' => $request->target], $validated);
            return redirect()->route('admin.manage-admins.index')->with(['success' => ['Admin Created Successfull']]);
        } catch (\Exception $e) {
            return back()->with(['error' => [SOMETHING_WRONG]]);
        }

    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function edit($id)
    {
        Gate::authorize('edit-admin');
        $this->setPageTitle('Edit Admin');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Admins' => route('admin.manage-admins.index'), 'Edit' => ''];
        $admin = Admin::findOrFail($id);
        $roles = Role::latest()->get();
        $form_type = 'edit';
        return view('admin.sections.admins.form', compact('breadcrumb', 'roles', 'admin','form_type'));
    }

     /**
     * Role Delete
     *
     * @method DELETE
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function delete(Request $request){

        Gate::authorize('delete-admin');

        $validator = Validator::make($request->all(),[
            'target' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            $admin = Admin::find($validated['target']);
            if($admin->delatable == true){
                $image_path = getFilesPath('admin-profile').'/'.$admin->image;
                deleteFile($image_path);
                $admin->delete();
            }else{
                return back()->with(['error' => ['Can\'t Delete Default Admin']]);
            }
        } catch (\Exception $th) {
            return back()->with(['error' => ['Something Went Wrong, Please Try Again']]);
        }

        return redirect()->route('admin.manage-admins.index')->with(['success' => ['Admin Deleted Successful']]);
    }


    public function search(Request $request){
        if($request->ajax()){
            $admins = Admin::search($request->text)->limit(15)->get();
            $returnHTML = view('admin.includes.search.admin-table', compact('admins'))->render();
            return JsonResponse::success(['success' => ['Admin Search Successfully!']], $returnHTML);
        }
    }
}
