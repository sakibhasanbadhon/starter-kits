<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Language;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function index()
    {
        Gate::authorize('access-languages');
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Languages' => ''];
        $this->setPageTitle('Languages Section');
        $languages = Language::get();
        return view('admin.sections.language.index', compact('breadcrumb', 'languages'));
    }


    public function store(Request $request){
        Gate::authorize('create-languages');

        $validated = $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:10',
            'direction' => 'required|in:ltr,rtl',
        ]);

        $data['name']        = $request->name;
        $data['code']        = $request->code;
        $data['direction']   = $request->direction;
        $data['details']     = $request->details;
        $data['modified_by'] = Auth::id();

        try {
            Language::create($data);
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with(['error' => [__('Something went wrong. Please try again')]]);
        }

        return back()->with(['success' => [__('Language added successfully').'!']]);
    }


    public function statusUpdate(Request $request)
    {
        if ($request->ajax()) {
            Gate::authorize('delete-languages');
            $request->validate([
                'target' => 'required|exists:languages,id',
                'status'  => 'required|boolean',
            ]);

            $language = Language::find($request->target);
            $language->status = $request->status;
            $language->save();

            return response()->json([
                'message' => 'Language status updated successfully.',
                'status'  => $language->status,
            ]);
        }
        return response()->json([
            'message' => 'Invalid request.',
        ], 400);
    }


    public function update(Request $request)
    {
        Gate::authorize('edit-languages');
        $validated = $request->validate([
            'target'    => 'required|exists:languages,id',
            'name'      => 'required|max:100|unique:languages,name,'.$request->target, // Ignore current record
            'code'      => 'required|max:20|unique:languages,code,'.$request->target,   // Ignore current record
            'direction' => 'required|in:ltr,rtl',
        ]);

        try {
            $language = Language::findOrFail($validated['target']);

            $data = [
                'name'        => $request->name,
                'code'        => $request->code,
                'direction'   => $request->direction,
                'modified_by' => Auth::id(),
            ];

            $language->update($data);

            return redirect()->route('admin.languages.index')
                ->with(['success' => [__('Language updated successfully').'!']]);

        } catch (Exception $e) {
            return back()->with(['error' => [__('Something went wrong. Please try again')]])->withInput();
        }
    }



    public function delete(Request $request) {
        Gate::authorize('delete-languages');
        $request->validate([
            'target'    => 'required|string',
        ]);

        $setup_language = Language::findOrFail($request->target);

        try{
            $setup_language->delete();
        }catch(Exception $e) {
            return back()->with(['error' => [__('Something went wrong. Please try again')]]);
        }

        return back()->with(['success' => [__('Language deleted successfully').'!']]);
    }
}
