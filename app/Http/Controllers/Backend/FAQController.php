<?php

namespace App\Http\Controllers\Backend;

use App\Models\FAQ;
use App\Services\FAQService;
use App\Traits\ResponseData;
use Illuminate\Http\Request;
use App\Http\Requests\FAQRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class FAQController extends Controller
{
    use ResponseData;

    protected $faq;

    public function __construct(FAQService $faqService)
    {
        $this->faq = $faqService;
    }

    /**
     * Admin index page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function index(Request $request){
        // authorized 403
        Gate::authorize('faq-access');

        if($request->ajax()){
            return $this->faq->allData($request);
        }

        $breadcrumb = ["FAQ List" => ''];
        $this->setPageTitle('FAQ List');
        return view('backend.faq.index', compact('breadcrumb'));
    }

    /**
     * Form page show
     *
     * @method GET
     * @return Illuminate\Http\Request Response
     */
    public function create(){
        // authorized 403
        Gate::authorize('faq-create');

        $this->setPageTitle('Create FAQ');
        $data['breadcrumb'] = ["FAQ List" => route('admin.faqs.index'), "Create" => ''];
        return view('backend.faq.store-or-update', $data);
    }

    /**
     * Role store
     *
     * @method POST
     * @param @return Illuminate\Http\Request $request
     * @return Illuminate\Http\Request Response
     */
    public function storeOrUpdate(FAQRequest $request){
        if(permission('faq-create') || permission('faq-edit')){
            $result = $this->faq->storeOrUpdateData($request);
            if($result){
                if($request->update_id){
                    return redirect()->route('admin.faqs.index')->with('success','FAQ updated successfull.');
                }else{
                    return redirect()->route('admin.faqs.index')->with('success','FAQ saved successfull.');
                }
            }else{
                return redirect()->back()->with('error','FAQ cannot be created!');
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
        Gate::authorize('faq-edit');

        $data['edit'] = FAQ::findOrFail($id);

        $this->setPageTitle('Edit FAQ');
        $data['breadcrumb'] = ["Edit FAQ" => route('admin.faqs.index') , "Edit FAQ" => ''];
        return view('backend.faq.store-or-update', $data);
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
            if(permission('faq-status')){
                return $this->faq->statusData($request->id,$request->status);
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
            if(permission('faq-delete')){
                return $this->faq->deleteData($request->id);
            }else{
                return $this->responseJson('error', UNAUTHORIZED_MSG);
            }
        }
    }
}
