@extends('backend.layouts.app')
@section('title', $title)
@push('styles')

@endpush
@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header py-2">
                    <h5 class="mb-0 cd-title">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faqs.store-or-update') }}" method="POST">
                        @csrf
                        @isset($edit)
                            <input type="hidden" name="update_id" value="{{ $edit->id }}">
                        @endisset
                        <x-forms.textarea labelName="Question" name="question" required="required" value="{{ isset($edit) ? $edit->question : old('question') }}" placeholder="Enter faq question"/>
                        <x-forms.textarea labelName="Answer" name="answer" required="required" value="{{ isset($edit) ? $edit->answer : old('answer') }}" placeholder="Enter faq answer"/>
                        <x-forms.selectbox labelName="Status" name="status" required="required">
                            @foreach (STATUS as $id=>$name)
                            <option value="{{ $id }}" @isset($edit) {{ $edit->status == $id ? 'selected' : '' }} @endisset>{{ $name }}</option>
                            @endforeach
                        </x-forms.selectbox>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-primary shadow-none px-2"><i class="fa fa-save fa-sm"></i>
                                @isset($edit)
                                Update
                                @else
                                Save
                                @endisset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
