<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Constants\GlobalConst;
use App\Http\Helpers\Response;
use App\Models\Admin\Language;
use App\Constants\LanguageConst;
use App\Models\Admin\SiteSections;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Constants\SiteSectionConst;

class ContentManagerController extends Controller
{
    protected $activeLanguages;
    protected $contentDefinitions;

    public function __construct()
    {
        $this->activeLanguages = Language::get();
        $this->initializeContentDefinitions();
    }

    /**
     * Define all content sections and their handlers
     */
    private function initializeContentDefinitions()
    {
        $this->contentDefinitions = [
            'main-banner' => [
                'display'   => 'renderBannerPage',
                'persist'   => 'persistBannerData',
                'add'       => null,
                'modify'    => null,
                'remove'    => null,
                'toggle'    => null,
            ],

            'process-flow' => [
                'display'   => 'renderProcessFlowPage',
                'persist'   => 'persistProcessFlowData',
                'add'       => 'addProcessFlowItem',
                'modify'    => 'updateProcessFlowItem',
                'remove'    => 'deleteProcessFlowItem',
                'toggle'    => 'toggleProcessFlowItemStatus',
            ],
        ];
    }

    /**
     * Get the appropriate handler method for the requested action
     */
    private function resolveHandler($pageKey, $action)
    {
        if (!array_key_exists($pageKey, $this->contentDefinitions)) {
            abort(404);
        }

        if (!isset($this->contentDefinitions[$pageKey][$action])) {
            abort(404);
        }

        return $this->contentDefinitions[$pageKey][$action];
    }

    /**
     * Display content page based on page key
     */
    public function displayContentPage($pageKey)
    {
        $handler = $this->resolveHandler($pageKey, 'display');
        return $this->$handler($pageKey);
    }

    /**
     * Save content data for a page
     */
    public function saveContentData(Request $request, $pageKey)
    {
        $handler = $this->resolveHandler($pageKey, 'persist');
        return $this->$handler($request, $pageKey);
    }

    /**
     * Add new content item
     */
    public function addContentItem(Request $request, $pageKey)
    {
        $handler = $this->resolveHandler($pageKey, 'add');
        return $this->$handler($request, $pageKey);
    }

    /**
     * Modify existing content item
     */
    public function editContentItem(Request $request, $pageKey)
    {
        $handler = $this->resolveHandler($pageKey, 'modify');
        return $this->$handler($request, $pageKey);
    }

    /**
     * Delete content item
     */
    public function deleteContentItem(Request $request, $pageKey)
    {
        $handler = $this->resolveHandler($pageKey, 'remove');
        return $this->$handler($request, $pageKey);
    }

    /**
     * Toggle item status
     */
    public function changeItemStatus(Request $request, $pageKey)
    {
        $handler = $this->resolveHandler($pageKey, 'toggle');
        return $this->$handler($request, $pageKey);
    }

    /**
     * ==================== BANNER SECTION HANDLERS ====================
     */

    /**
     * Display banner configuration page
     */
    public function renderBannerPage($pageKey)
    {
        $pageTitle = "Hero Banner Configuration";
        $storageKey = Str::slug(SiteSectionConst::BANNER_SECTION);
        $contentData = SiteSections::getData($storageKey)->first();
        $availableLanguages = $this->activeLanguages;

        return view('admin.sections.content.banner-section', compact(
            'pageTitle',
            'contentData',
            'availableLanguages',
            'pageKey',
        ));
    }

    /**
     * Save banner data
     */
    public function persistBannerData(Request $request, $pageKey)
    {
        $fieldDefinitions = [
            'main_heading'      => "required|string|max:100",
            'secondary_heading' => "required|string",
            'action_button'     => "required|string|max:50",
        ];

        $storageKey = Str::slug(SiteSectionConst::BANNER_SECTION);
        $existingData = SiteSections::where("key", $storageKey)->first();

        $preparedData['visual'] = $existingData->value->visual ?? null;

        if ($request->hasFile("cover_image")) {
            $preparedData['visual'] = $this->processImageUpload($request, "cover_image", $existingData->value->visual ?? null);
        }

        $preparedData['localized'] = $this->processLocalizedContent($request, $fieldDefinitions);
        $finalData['value'] = $preparedData;
        $finalData['key'] = $storageKey;

        try {
            SiteSections::updateOrCreate(['key' => $storageKey], $finalData);
        } catch (Exception $e) {
            return back()->with(['error' => ['Unable to save changes. Please try again.']]);
        }

        return back()->with(['success' => ['Banner section updated successfully!']]);
    }

    /**
     * ==================== PROCESS FLOW (HOW IT WORKS) HANDLERS ====================
     */

    /**
     * Display process flow page
     */
    public function renderProcessFlowPage($pageKey)
    {
        $pageTitle = "Process Flow Configuration";
        $storageKey = Str::slug(SiteSectionConst::HOW_IT_WORK_SECTION);
        $contentData = SiteSections::getData($storageKey)->first();
        $availableLanguages = $this->activeLanguages;

        return view('admin.sections.content.process-flow-section', compact(
            'pageTitle',
            'contentData',
            'availableLanguages',
            'pageKey',
        ));
    }

    /**
     * Save process flow main data
     */
    public function persistProcessFlowData(Request $request, $pageKey)
    {
        $fieldDefinitions = [
            'section_header'    => "required|string|max:100",
            'section_caption'   => "required|string",
        ];

        $storageKey = Str::slug(SiteSectionConst::HOW_IT_WORK_SECTION);
        $existingData = SiteSections::where("key", $storageKey)->first();

        $validator = Validator::make($request->all(), [
            'featured_image' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $preparedData = $existingData ? json_decode(json_encode($existingData->value), true) : [];
        $preparedData['visual'] = $existingData->value->visual ?? "";

        if ($request->hasFile("featured_image")) {
            $preparedData['visual'] = $this->processImageUpload($request, "featured_image", $existingData->value->visual ?? null);
        }

        $preparedData['localized'] = $this->processLocalizedContent($request, $fieldDefinitions);
        $finalData['value'] = $preparedData;
        $finalData['key'] = $storageKey;

        try {
            SiteSections::updateOrCreate(['key' => $storageKey], $finalData);
        } catch (Exception $e) {
            return back()->with(['error' => ['Unable to save changes. Please try again.']]);
        }

        return back()->with(['success' => ['Process flow section updated successfully!']]);
    }

    /**
     * Add new process step
     */
    public function addProcessFlowItem(Request $request, $pageKey)
    {
        $fieldDefinitions = [
            'step_name' => "required|string|max:255",
        ];

        $localizedData = $this->processLocalizedContent($request, $fieldDefinitions, "process-add-modal");

        if ($localizedData instanceof RedirectResponse) {
            return $localizedData;
        }

        $storageKey = Str::slug(SiteSectionConst::HOW_IT_WORK_SECTION);
        $existingData = SiteSections::where("key", $storageKey)->first();

        $sectionData = $existingData ? json_decode(json_encode($existingData->value), true) : [];

        $uniqueIdentifier = uniqid();

        $sectionData['items'][$uniqueIdentifier]['localized'] = $localizedData;
        $sectionData['items'][$uniqueIdentifier]['identifier'] = $uniqueIdentifier;
        $sectionData['items'][$uniqueIdentifier]['is_active'] = 1;

        $finalData['key'] = $storageKey;
        $finalData['value'] = $sectionData;

        try {
            SiteSections::updateOrCreate(['key' => $storageKey], $finalData);
        } catch (Exception $e) {
            return back()->with(['error' => ['Failed to add new process step.']]);
        }

        return back()->with(['success' => ['Process step added successfully!']]);
    }

    /**
     * Update existing process step
     */
    public function updateProcessFlowItem(Request $request, $pageKey)
    {
        $request->validate([
            'item_reference' => 'required|string',
        ]);

        $fieldDefinitions = [
            'step_name_edit' => "required|string|max:255",
        ];

        $storageKey = Str::slug(SiteSectionConst::HOW_IT_WORK_SECTION);
        $existingData = SiteSections::getData($storageKey)->first();

        if (!$existingData) {
            return back()->with(['error' => ['Content section not found!']]);
        }

        $sectionData = json_decode(json_encode($existingData->value), true);

        if (!isset($sectionData['items'])) {
            return back()->with(['error' => ['No items found in this section!']]);
        }

        if (!array_key_exists($request->item_reference, $sectionData['items'])) {
            return back()->with(['error' => ['Invalid item reference']]);
        }

        $localizedData = $this->processLocalizedContent($request, $fieldDefinitions, "process-edit-modal");

        if ($localizedData instanceof RedirectResponse) {
            return $localizedData;
        }

        // Remove '_edit' suffix from field names
        $localizedData = array_map(function ($languageContent) {
            $cleanedContent = [];
            foreach ($languageContent as $key => $value) {
                $cleanedContent[str_replace('_edit', '', $key)] = $value;
            }
            return $cleanedContent;
        }, $localizedData);

        $sectionData['items'][$request->item_reference]['localized'] = $localizedData;

        try {
            $existingData->update([
                'value' => $sectionData,
            ]);
        } catch (Exception $e) {
            return back()->with(['error' => ['Failed to update process step.']]);
        }

        return back()->with(['success' => ['Process step updated successfully!']]);
    }

    /**
     * Delete process step
     */
    public function deleteProcessFlowItem(Request $request, $pageKey)
    {
        $request->validate([
            'item_reference' => 'required|string',
        ]);

        $storageKey = Str::slug(SiteSectionConst::HOW_IT_WORK_SECTION);
        $existingData = SiteSections::getData($storageKey)->first();

        if (!$existingData) {
            return back()->with(['error' => ['Content section not found!']]);
        }

        $sectionData = json_decode(json_encode($existingData->value), true);

        if (!isset($sectionData['items'])) {
            return back()->with(['error' => ['No items found in this section!']]);
        }

        if (!array_key_exists($request->item_reference, $sectionData['items'])) {
            return back()->with(['error' => ['Invalid item reference!']]);
        }

        try {
            unset($sectionData['items'][$request->item_reference]);
            $existingData->update([
                'value' => $sectionData,
            ]);
        } catch (Exception $e) {
            return back()->with(['error' => ['Failed to delete process step.']]);
        }

        return back()->with(['success' => ['Process step removed successfully!']]);
    }

    /**
     * Toggle process step status
     */
    public function toggleProcessFlowItemStatus(Request $request, $pageKey)
    {
        $validator = Validator::make($request->all(), [
            'status_flag'       => 'required|boolean',
            'target_reference'  => 'required|string',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return Response::error($validator->errors()->all(), null, 400);
        }

        $storageKey = Str::slug(SiteSectionConst::HOW_IT_WORK_SECTION);
        $existingData = SiteSections::where("key", $storageKey)->first();

        $sectionData = $existingData ? json_decode(json_encode($existingData->value), true) : [];

        if (array_key_exists("items", $sectionData) && array_key_exists($request->target_reference, $sectionData['items'])) {
            $sectionData['items'][$request->target_reference]['is_active'] = ($request->status_flag == 1) ? 0 : 1;
        } else {
            return Response::error(['Item not found or invalid!'], [], 404);
        }

        $existingData->update([
            'value' => $sectionData,
        ]);

        return Response::success([__('Item status updated successfully!')], [], 200);
    }

    /**
     * ==================== HELPER METHODS ====================
     */

    /**
     * Get all languages with special handling for default
     */
    private function getAllLanguages()
    {
        $languages = Language::whereNot('code', LanguageConst::NOT_REMOVABLE)
            ->select("code", "name")
            ->get()
            ->toArray();

        $languages[] = [
            'name' => LanguageConst::NOT_REMOVABLE_CODE,
            'code' => LanguageConst::NOT_REMOVABLE,
        ];

        return $languages;
    }

    /**
     * Process and validate multilingual content
     */
    private function processLocalizedContent($request, $fieldDefinitions, $modalReference = null)
    {
        $availableLanguages = $this->getAllLanguages();
        $defaultLocale = get_default_language_code();

        $validationRules = [];
        $localizedContent = [];

        foreach ($request->all() as $inputName => $inputValue) {
            foreach ($availableLanguages as $language) {
                $nameParts = explode("_", $inputName);
                $langCode = array_shift($nameParts);
                $fieldName = implode("_", $nameParts);

                if ($langCode == $language['code'] && array_key_exists($fieldName, $fieldDefinitions)) {
                    $code = $language['code'];

                    if ($defaultLocale == $code) {
                        $validationRules[$inputName] = $fieldDefinitions[$fieldName];
                    } else {
                        $validationRules[$inputName] = str_replace("required", "nullable", $fieldDefinitions[$fieldName]);
                    }

                    $localizedContent[$code][$fieldName] = $inputValue;
                }
            }
        }

        if ($modalReference === null) {
            $validated = Validator::make($request->all(), $validationRules)->validate();
        } else {
            $validator = Validator::make($request->all(), $validationRules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with("modal", $modalReference);
            }
            $validated = $validator->validate();
        }

        return $localizedContent;
    }

    /**
     * Process and validate image uploads
     */
    private function processImageUpload($request, $fieldName, $existingImage = null)
    {
        if ($request->hasFile($fieldName)) {
            $validation = Validator::make($request->only($fieldName), [
                $fieldName => "image|mimes:png,jpg,webp,jpeg,svg",
            ])->validate();

            $fileData = get_files_from_fileholder($request, $fieldName);
            $uploadedPath = upload_files_from_path_dynamic($fileData, 'site-section', $existingImage);

            return $uploadedPath;
        }

        return false;
    }
}
