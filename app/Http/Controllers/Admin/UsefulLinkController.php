<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin\Pages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Constants\GlobalConst;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsefulLinkController extends Controller
{
    public function index()
    {
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Usefull Link' => ''];
        $type = Str::slug(GlobalConst::USEFUL_LINKS);
        $useful_link = Pages::where('type', $type)->get();
        return view('admin.sections.useful-links.index', compact('breadcrumb', 'type', 'useful_link'));
    }


    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:100',
            'details' => 'required',
        ]);

        $type = Str::slug(GlobalConst::USEFUL_LINKS);

        $data['title']        = $request->title;
        $data['type']         = $type;
        $data['details']      = $request->details;
        $data['slug']         = Str::slug($request->title);
        $data['last_edit_by'] = Auth::id();

        try {
            Pages::create($data);
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with(['error' => [__('Something went wrong. Please try again')]]);
        }

        return back()->with(['success' => [__('Page added successfully').'!']]);
    }


    public function statusUpdate(Request $request)
    {
        $request->validate([
            'target' => 'required|exists:pages,id',
            'status'  => 'required|boolean',
        ]);

        $pages = Pages::find($request->target);
        $pages->status = $request->status;
        $pages->save();

        return response()->json([
            'message' => 'User status updated successfully.',
            'status'  => $pages->status,
        ]);
    }



     public function update(Request $request){

        $validated = $request->validate([
            'target'  => 'required',
            'title' => 'required|max:100',
            'details' => 'required',
        ]);


        $data['title']        = $request->title;
        $data['details']      = $request->details;
        $data['slug']         = Str::slug($request->title);
        $data['last_edit_by'] = Auth::id();

        $setup_page = Pages::findOrFail($validated['target']);

        try {
            $setup_page->update($data);
        } catch (Exception $th) {
            return back()->with(['error' => [__('Something went wrong. Please try again')]]);
        }

        return redirect()->route('admin.useful-links.index')->with(['success' => [__('Page updated successfully').'!']]);
    }


}
