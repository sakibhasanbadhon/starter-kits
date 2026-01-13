<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin\Role;
use App\Models\Admin\Admin;
use App\Models\Testimonial;
use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TestimonialService;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TestimonialRequest;

class TestimonialController extends Controller
{
    use ResponseData;

    protected $testimonial;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonial = $testimonialService;
    }

    /**
     * Admin index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index(Request $request){
        // authorized 403
        Gate::authorize('testimonial-access');

        if($request->ajax()){
            return $this->testimonial->allData($request);
        }

        $breadcrumb = ["Testimonial List" => ''];
        $this->setPageTitle('Testimonial List');
        return view('backend.testimonial.index', compact('breadcrumb'));
    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function create(){
        // authorized 403
        Gate::authorize('testimonial-create');

        $this->setPageTitle('Create Testimonial');
        $data['breadcrumb'] = ["Testimonial List" => route('admin.testimonials.index'), "Create" => ''];
        return view('backend.testimonial.form', $data);
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function storeOrUpdate(TestimonialRequest $request){
        if(permission('admin-create') || permission('admin-edit')){
            $result = $this->testimonial->storeOrUpdateData($request);
            if($result){
                if($request->update_id){
                    return redirect()->route('admin.testimonials.index')->with('success','Testimonial updated successfull.');
                }else{
                    return redirect()->route('admin.testimonials.index')->with('success','Testimonial saved successfull.');
                }
            }else{
                return redirect()->back()->with('error','Testimonial cannot be created!');
            }
        }else {
            return abort(403);
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
        Gate::authorize('testimonial-edit');

        $data['edit'] = Testimonial::findOrFail($id);

        $this->setPageTitle('Edit Testimonial');
        $data['breadcrumb'] = ["Edit Testimonial" => route('admin.testimonials.index') , "Edit Testimonial" => ''];
        $data['roles'] = Role::latest()->get();
        return view('backend.testimonial.form', $data);
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
            if(permission('testimonial-status')){
                return $this->testimonial->statusData($request->id,$request->status);
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
            if(permission('testimonial-delete')){
                return $this->testimonial->deleteData($request->id);
            }else{
                return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }
}
