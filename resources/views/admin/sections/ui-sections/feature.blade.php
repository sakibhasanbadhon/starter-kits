@extends('admin.layouts.app')

@php
    $local_lang  = display_app_lang_code();
    $default    = App\Constants\GlobalConst::DEFAULT_LANG;
    $languages_for_json = $availableLanguages->toJson();

@endphp

@push('style')
<!-- Make sure Font Awesome is loaded -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('public/backend/css/fontawesome-iconpicker.min.css') }}">
<style>
    .fileholder {
        min-height: 374px !important;
    }
    .fileholder-files-view-wrp.accept-single-file .fileholder-single-file-view,
    .fileholder-files-view-wrp.fileholder-perview-single .fileholder-single-file-view {
        height: 330px !important;
    }
    .iconpicker-popover {
        opacity: 1 !important;
        visibility: visible !important;
        z-index: 9999 !important;
    }
</style>
@endpush

@section('content')

<div class="row modern-card">
    <!-- Left Side - Tabs -->
    <div class="col-md-4 col-lg-3 p-0">
        <div class="tabs-left-container">
            <div class="badge-premium text-center d-flex justify-content-center">
                <div>
                    <i class="fas fa-globe mr-2"></i>
                    <span>All Languages</span>
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($availableLanguages as $index => $item)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                           id="tab-{{ $item->id }}"
                           data-toggle="tab"
                           href="#content-{{ $item->id }}"
                           role="tab"
                           aria-controls="content-{{ $item->id }}"
                           aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            <span>{{ $item->name }}</span>
                            <i class="fas fa-chevron-right ml-auto"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Right Side - Content -->
    <div class="col-md-8 col-lg-9 p-0">
        <div class="tab-content-wrapper">

            <form action="{{ route('admin.ui-content.save',$pageKey) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="tab-content" id="myTabContent">
                    @foreach ($availableLanguages as $index => $item)
                        @php
                            $lang_code = $item->code;
                        @endphp
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="content-{{ $item->id }}"
                            role="tabpanel"
                            aria-labelledby="tab-{{ $item->id }}">

                            <div class="content-card card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-muted">
                                        <i class="fas fa-language me-2"></i>Enter details for {{ $item->name }}
                                    </h6>
                                    <div class="row">
                                        {{-- @dd($contentData->value->lang->$lang_code->title) --}}

                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_title"
                                                labelName="Title ({{ $item->name }})"
                                                placeholder="Enter title"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_title', $contentData->value->lang->$lang_code->title ?? '') }}">
                                            </x-forms.textbox>
                                        </div>

                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_subtitle"
                                                labelName="Subtitle ({{ $item->name }})"
                                                placeholder="Enter subtitle"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_subtitle', $contentData->value->lang->$lang_code->subtitle ?? '') }}">
                                            </x-forms.textbox>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5 py-3"
                                style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="fas fa-paper-plane mr-2"></i> Submit
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- item --}}

<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Language Content</h5>

                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus button-icon"></i> {{ __('Add New') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Icon</th>
                                    <th width="25%">Title</th>
                                    <th width="35%">Subtitle</th>
                                    <th width="25%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contentData->value->items ?? [] as $index => $item)
                                   {{-- @dd() --}}
                                    <tr data-item="{{ json_encode($item) }}">
                                        <td>
                                            <span class="icon-preview me-2">
                                                <i class="{{ $item->lang->$local_lang->item_icon ?? 'fas fa-question-circle' }}"></i>
                                            </span>
                                        </td>
                                        <td>{{ $item->lang->$local_lang->item_title ?? 'No title' }}</td>
                                        <td>{{ $item->lang->$local_lang->item_subtitle ?? 'No subtitle' }}</td>
                                        <td>
                                            <button data-toggle="modal" data-target=".bd-example-modal-lg-edit" title="Edit" class="action-btn edit-modal-button">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button class="action-btn action-danger" onclick="deleteItem('{{ $lang_code }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="fas fa-language fa-3x text-muted mb-3"></i>
                                                <h6>No Languages Found</h6>
                                                <p class="text-muted">Click the "Add New" button to add language content.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- add Modal --}}
<div class="modal fade bd-example-modal-lg" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Add New Feature') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form action="{{ route('admin.ui-content.item.create', $pageKey) }}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <!-- Modern Card Layout -->
                    <div class="row modern-card m-0">
                        <!-- Left Side - Language Tabs -->
                        <div class="col-md-4 col-lg-3 p-0">
                            <div class="tabs-left-container">
                                <div class="badge-premium text-center d-flex justify-content-center">
                                    <div>
                                        <i class="fas fa-globe mr-2"></i>
                                        <span>Languages</span>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs" id="modalTab" role="tablist">
                                    @foreach ($availableLanguages as $index => $item)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                               id="modal-tab-{{ $item->id }}"
                                               data-toggle="tab"
                                               href="#modal-content-{{ $item->id }}"
                                               role="tab"
                                               aria-controls="modal-content-{{ $item->id }}"
                                               aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                <span>{{ $item->name }}</span>
                                                <i class="fas fa-chevron-right ml-auto"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Right Side - Content Forms -->
                        <div class="col-md-8 col-lg-9 p-0">
                            <div class="tab-content-wrapper">
                                <div class="tab-content" id="modalTabContent">
                                    @foreach ($availableLanguages as $index => $item)
                                        @php
                                            $lang_code = $item->code;
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="modal-content-{{ $item->id }}"
                                             role="tabpanel"
                                             aria-labelledby="modal-tab-{{ $item->id }}">

                                            <div class="content-card card border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-3 text-muted">
                                                        <i class="fas fa-language me-2"></i>Enter details for {{ $item->name }}
                                                    </h6>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-forms.textbox
                                                                name="{{ $lang_code }}_item_icon"
                                                                labelName="Title ({{ $item->name }})"
                                                                placeholder="Enter title"
                                                                required="required"
                                                                type="text"
                                                                class="form-control icp icp-auto iconpicker-element iconpicker-input">
                                                            </x-forms.textbox>
                                                            <small class="text-muted">Enter Font Awesome or Bootstrap icon class</small>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <x-forms.textbox
                                                                name="{{ $lang_code }}_item_title"
                                                                labelName="Title ({{ $item->name }})"
                                                                placeholder="Enter title"
                                                                required="required"
                                                                type="text">
                                                            </x-forms.textbox>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">
                                                                <i class="fas fa-quote-right me-2"></i>Subtitle ({{ $item->name }})
                                                            </label>
                                                            <textarea class="form-control"
                                                                    name="{{ $lang_code }}_item_subtitle"
                                                                    rows="3"
                                                                    placeholder="Enter subtitle"
                                                                    required>
                                                            </textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-2"></i>Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-2"></i>Save Content
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade bd-example-modal-lg-edit" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Feature') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form action="{{ route('admin.ui-content.item.create', $pageKey) }}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <!-- Modern Card Layout -->
                    <div class="row modern-card m-0">
                        <!-- Left Side - Language Tabs -->
                        <div class="col-md-4 col-lg-3 p-0">
                            <div class="tabs-left-container">
                                <div class="badge-premium text-center d-flex justify-content-center">
                                    <div>
                                        <i class="fas fa-globe mr-2"></i>
                                        <span>Languages</span>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs" id="modalTab" role="tablist">
                                    @foreach ($availableLanguages as $index => $item)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                               id="modal-tab-{{ $item->id }}"
                                               data-toggle="tab"
                                               href="#modal-content-{{ $item->id }}"
                                               role="tab"
                                               aria-controls="modal-content-{{ $item->id }}"
                                               aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                <span>{{ $item->name }}</span>
                                                <i class="fas fa-chevron-right ml-auto"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Right Side - Content Forms -->
                        <div class="col-md-8 col-lg-9 p-0">
                            <div class="tab-content-wrapper">
                                <div class="tab-content" id="modalTabContent">
                                    @foreach ($availableLanguages as $index => $item)
                                        @php
                                            $lang_code = $item->code;
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="modal-content-{{ $item->id }}"
                                             role="tabpanel"
                                             aria-labelledby="modal-tab-{{ $item->id }}">

                                            <div class="content-card card border-0">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-3 text-muted">
                                                        <i class="fas fa-language me-2"></i>Enter details for {{ $item->name }}
                                                    </h6>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <x-forms.textbox
                                                                name="{{ $lang_code }}_item_icon_edit"
                                                                labelName="Icon ({{ $item->name }})"
                                                                placeholder="Enter icon class"
                                                                required="required"
                                                                type="text"
                                                                class="form-control icp icp-auto iconpicker-element iconpicker-input">
                                                            </x-forms.textbox>
                                                            <small class="text-muted">Enter Font Awesome or Bootstrap icon class</small>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <x-forms.textbox
                                                                name="{{ $lang_code }}_item_title_edit"
                                                                labelName="Title ({{ $item->name }})"
                                                                placeholder="Enter title"
                                                                required="required"
                                                                type="text">
                                                            </x-forms.textbox>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">
                                                                <i class="fas fa-quote-right me-2"></i>Subtitle ({{ $item->name }})
                                                            </label>
                                                            <textarea class="form-control"
                                                                    name="{{ $lang_code }}_item_subtitle_edit"
                                                                    rows="3"
                                                                    placeholder="Enter subtitle"
                                                                    required>
                                                            </textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-2"></i>Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-2"></i>Save Content
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>




@endsection


@push('script')
<script src="{{ asset('public/backend/js/fontawesome-iconpicker.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize icon picker
    if (typeof $.fn.iconpicker === 'function') {
        $('.icp-auto').each(function() {
            var $this = $(this);
            $this.iconpicker({
                title: 'Select Icon',
                selected: false,
                defaultValue: false,
                placement: 'bottom'
            });

            // Update icon on change
            $this.on('iconpickerSelected', function(e) {
                $(this).val(e.iconpickerValue);
            });
        });

        // Handle tab changes
        $('button[data-bs-toggle="tab"], a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $('.icp-auto').each(function() {
                var $this = $(this);
                if ($this.data('iconpicker')) {
                    $this.iconpicker('destroy');
                }
                $this.iconpicker({
                    title: 'Select Icon',
                    selected: false,
                    defaultValue: false,
                    placement: 'bottom'
                });
            });
        });
    } else {
        console.error('Iconpicker plugin not loaded');
    }
});
</script>

<script>
    var default = "{{ $default }}";
    var local_lang = "{{ $local_lang }}";
    var languages = "{{ $languages_for_json }}";
    languages     = JSON.parse(languages.replace(/&quot;/g,'"'));

    $(".edit-modal-button").click(function(){
        alert("Edit button clicked!"); // Debugging alert
        var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
        var editModal = $("#feature-edit");

        editModal.find("form").first().find("input[name=target]").val(oldData.id);
        editModal.find("input[name="+default+"_item_title_edit]").val(oldData.language[default].item_title);
        $.each(languages,function(index,item) {
            editModal.find("input[name="+item.code+"_item_title_edit]").val((oldData.language[item.code] == undefined) ? "" : oldData.language[item.code].item_title);
        });
        openModalBySelector("#feature-edit");
    });
</script>
@endpush
