@extends('admin.layouts.app')

@push('style')
<link rel="stylesheet" href="{{ asset('public/backend/css/fontawesome-iconpicker.min.css') }}">
<style>
        .fileholder {
            min-height: 374px !important;
        }

        .fileholder-files-view-wrp.accept-single-file .fileholder-single-file-view,.fileholder-files-view-wrp.fileholder-perview-single .fileholder-single-file-view{
            height: 330px !important;
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_icon"
                                                labelName="Icon ({{ $item->name }})"
                                                placeholder="Enter icon class (e.g., bi bi-truck)"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_icon', $contentData->value->lang->$lang_code->icon ?? '') }}"
                                                class="icp icp-auto iconpicker-element iconpicker-input">
                                            </x-forms.textbox>
                                        </div>
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



@endsection


@push('script')
    <script src="{{ asset('public/backend/js/fontawesome-iconpicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize icon picker on all elements
            $('.icp-auto').iconpicker();

            // Reinitialize when tab is shown
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $('.icp-auto').iconpicker();
            });
        });
    </script>
@endpush
