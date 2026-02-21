<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Currencies;
use App\Http\Helpers\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Setup Currency";
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Currencies' => ''];
        $currencies = Currencies::orderByDesc('default')->paginate(10);

        return view('admin.sections.currency.index', compact(
            'page_title',
            'currencies',
            'breadcrumb'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "Create Currency";
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Currencies' => route('admin.currencies.index'), 'Create' => ''];
        return view('admin.sections.currency.create', compact('page_title', 'breadcrumb'));
    }

    /**
     * Return countries list from JSON file.
     */
    public function getCountries()
    {
        $path = public_path('world/countries.json');
        $countries = json_decode(file_get_contents($path), true);
        return response()->json($countries);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country'   => 'required|string',
            'name'      => 'required|string',
            'code'      => 'required|string|unique:currencies',
            'symbol'    => 'required|string',
            'option'    => 'required|string',
            'flag'      => 'nullable|image|mimes: jpg,png,jpeg,svg,webp',
            'rate'      => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('modal', 'currency_add');
        }
        $validated = $validator->validate();



        $default = [
            'default' => true,
            'optional'  => false,
        ];

        // If Default is already available
        if ($default[$validated['option']] == true) {
            $check_default = Currencies::where('default', true);
            if ($check_default->count() > 0) {
                try {
                    $check_default->update([
                        'default'       => false,
                    ]);
                } catch (Exception $e) {
                    return back()->with(['error' => ['Default currency make failed! Please try again.']]);
                }
            }
        }

        $validated['type']          = 'FIAT';
        $validated['default']       = $default[$validated['option']];
        $validated['created_at']    = now();
        $validated['admin_id']      = Auth::user()->id;

        if ($request->hasFile('flag')) {
            $image = uploadLocalImage($request->flag, 'flag');
            $image_path = uploadImage([$image['dev_path']], 'flag');
            deleteFile($image['dev_path']);
            $validated['flag'] = $image_path;
        }

        $validated = Arr::except($validated, ['role', 'option']);
        // insert_data
        try {
            Currencies::create($validated);
        } catch (Exception $e) {
            return back()->withErrors($validator)->withInput()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Currency Saved Successfully!']]);
    }


    /**
     * Update Currency Status
     */
    public function statusUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'                    => 'required|boolean',
            'data_target'               => 'required|string',
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            $error = ['error' => $validator->errors()];
            return JsonResponse::error($error, null, 400);
        }
        $validated = $validator->safe()->all();
        $currency_code = $validated['data_target'];

        $currency = Currencies::where('code', $currency_code)->first();
        if (!$currency) {
            $error = ['error' => ['Currency record not found in our system.']];
            return JsonResponse::error($error, null, 404);
        }

        try {
            $currency->update([
                'status' => ($validated['status'] == true) ? false : true,
            ]);
        } catch (Exception $e) {
            $error = ['error' => ['Something went wrong!. Please try again.']];
            return JsonResponse::error($error, null, 500);
        }

        $success = ['success' => ['Currency status updated successfully!']];
        return JsonResponse::success($success, null, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = "Edit Currency";
        $currency = Currencies::findOrFail($id);
        $breadcrumb = ['Dashboard' => route('admin.dashboard'), 'Currencies' => route('admin.currencies.index'), 'Edit' => ''];
        return view('admin.sections.currency.edit', compact('page_title', 'breadcrumb', 'currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $currency = Currencies::find($request->target);
        if (!$currency) {
            return back()->with(['warning' => ['Currency not found!']]);
        }

        $validator = Validator::make($request->all(), [
            'country'   => 'required|string',
            'name'      => 'required|string',
            'code'      => ['required', 'string', Rule::unique('currencies', 'code')->ignore($currency->id)],
            'symbol'    => 'required|string',
            'rate'      => 'required|numeric',
            'option'    => 'required|string',
            'flag'      => 'nullable|image|mimes: jpg,png,jpeg,svg,webp',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validate();

        $default = [
            'default' => true,
            'optional'  => false,
        ];

        // If Default is already available
        if ($default[$validated['option']] == true) {
            $check_default = Currencies::where('default', true)->where('id', '!=', $currency->id);
            if ($check_default->count() > 0) {
                try {
                    $check_default->update([
                        'default'       => false,
                    ]);
                } catch (Exception $e) {
                    return back()->with(['error' => ['Default currency make failed! Please try again.']]);
                }
            }
        }

        $validated['default']       = $default[$validated['option']];

        if ($request->hasFile('flag')) {
            try {
                $image = uploadLocalImage($request->flag, 'flag', $request->old_flag);
                $image_path = uploadImage([$image['dev_path']], 'flag', $request->old_flag);
                deleteFile($image['dev_path']);
                $validated['flag'] = $image_path;
            } catch (Exception $e) {
                return back()->withErrors($validator)->withInput()->with(['error' => ['Image file upload failed!']]);
            }
        }

        $validated = Arr::except($validated, ['option']);

        try {
            $currency->update($validated);
        } catch (Exception $e) {
            return back()->withErrors($validator)->withInput()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return redirect()->route('admin.currencies.index')->with(['success' => ['Successfully updated the information.']]);
    }


    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'target'        => 'required|string|exists:currencies,code',
        ]);
        $validated = $validator->validate();
        $currency = Currencies::where("code", $validated['target'])->first();

        if ($currency->isDefault()) {
            return back()->with(['warning' => ['Can\'t deletable default currency.']]);
        }

        try {
            $image_path = getFilesPath('flag') . '/' . $currency->flag;
            deleteFile($image_path);
            $currency->delete();
        } catch (Exception $e) {
            return back()->with(['error' => ['Something went wrong! Please try again.']]);
        }

        return back()->with(['success' => ['Currency deleted successfully!']]);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text'  => 'required|string',
        ]);

        if ($validator->fails()) {
            $error = ['error' => $validator->errors()];
            return JsonResponse::error($error, null, 400);
        }

        $validated = $validator->validate();
        $currencies = Currencies::search($validated['text'])->select()->limit(10)->get();
        return view('admin.components.search.currency-search', compact(
            'currencies',
        ));
    }
}
