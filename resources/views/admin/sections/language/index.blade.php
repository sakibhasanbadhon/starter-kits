@extends('admin.layouts.app')

@section('button-area')
<div class="d-flex justify-content-end">

    <div class="link-area ml-3">
        {{-- @permission('create-languages') --}}
        {{-- <button class="btn btn-primary"><i class="fas fa-plus button-icon" data-toggle="modal" data-target=".bd-example-modal-lg"></i> {{ __('Add New') }}</button> --}}
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus button-icon"></i> {{ __('Add New') }}</button>
        {{-- @endpermission --}}
    </div>

</div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-body p-0">
                <div class="table-responsive user_table">
                    <table class="table table-striped text-nowrap m-0">
                        <thead>
                            <tr>
                                <th> SL</th>
                                <th> Name </th>
                                <th> Code </th>
                                <th> Direction </th>
                                <th> Status</th>
                                <th> Created At </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($languages ?? [] as $item)
                                <tr data-item="{{ json_encode($item) }}">
                                    <td style="width: 5%">{{ $loop->index + 1 }}</td>
                                    <td>{{ @$item->name }} </td>
                                    <td>{{ @$item->code }} </td>
                                    <td>{{ @$item->direction }}</td>
                                    <td>
                                        {{-- <span class="badge badge-sm py-1 px-2 fs-3 {{ $item->statusType['class'] }}">{{ $item->statusType['name'] }}</span> --}}
                                        <span class="badge badge-sm py-1 px-2 {{ $item->statusType['class'] }}">{{ $item->statusType['name'] }}</span>
                                    </td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="" title="Edit" class="action-btn edit-modal-button" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                        <a href="" title="Delete" class="action-btn text-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    @include('admin.includes.elements.empty-table')
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

    {{-- add Modal --}}

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Language</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.languages.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('Enter Name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ __('Code') }}</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="{{ __('Enter Code') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="direction">{{ __('Direction') }}</label>
                            <select name="direction" id="direction" class="form-control" required>
                                <option value="" disabled selected>{{ __('Select Direction') }}</option>
                                <option value="ltr">{{ __('Left to Right') }}</option>
                                <option value="rtl">{{ __('Right to Left') }}</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Language</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.languages.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="target" value="{{ old('target') }}">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('Enter Name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ __('Code') }}</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="{{ __('Enter Code') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="direction">{{ __('Direction') }}</label>
                            <select name="direction" id="direction" class="form-control" required>
                                <option value="" disabled selected>{{ __('Select Direction') }}</option>
                                <option value="ltr">{{ __('Left to Right') }}</option>
                                <option value="rtl">{{ __('Right to Left') }}</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')
<script>
        $(".edit-modal-button").click(function(){
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
            $("input[name=target]").val(oldData.id);
            $("input[name=name]").val(oldData.name);
            $("input[name=code]").val(oldData.code);
            $("select[name=direction]").val(oldData.direction);
        });

        $(document).on('click', '.delete-btn', function(e) {
            let method = 'POST';
            let url = "{{ route('admin.useful-links.delete') }}";
            let title = 'Delete Useful Link';
            let message = "Are Your Sure To Delete Useful Link?";
            let target = $(this).data('target');
            alertModalShow(method, url, title, message, target);
        });
</script>
@endpush
