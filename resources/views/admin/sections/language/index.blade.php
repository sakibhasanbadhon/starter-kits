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
                                            <label class="switch">
                                                @php
                                                    $status = (int) $item->status; // Make sure it's a strict integer
                                                @endphp
                                                <input type="checkbox" class="statusToggle" data-id="{{ $item->id }}" {{ $status === 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="ml-3 badge statusText-{{ $item->id }} {{ $status === 1 ? 'badge-success' : 'badge-warning' }}">
                                                {{ $status === 1 ? 'Active' : 'Deactive' }}
                                            </span>
                                        </td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button title="Edit" class="action-btn edit-modal-button" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>
                                         <button title="Delete" data-target="{{ $item->id }}" class="action-btn delete-btn action-danger mr-1"><i class="fas fa-trash-alt"></i></button>

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
                    <form action="{{ route('admin.languages.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Language</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

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
                            {{-- <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.languages.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Language</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            @method("PUT")
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
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@push('script')
<script>
    $(document).ready(function () {
            $('.statusToggle').on('change', function () {
                var $this = $(this);
                var target = $this.data('id');
                var status = $this.is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('admin.languages.status.update') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        target: target,
                        status: status
                    },
                    success: function (response) {
                        let $badge = $('.statusText-' + target);
                        $badge.text(status === 1 ? 'Active' : 'Deactive');
                        $badge
                            .removeClass('badge-success badge-warning')
                            .addClass(status === 1 ? 'badge-success' : 'badge-warning');

                        console.log(response.message);
                    },
                    error: function (response) {
                        console.log(response.message);
                        alert('Something went wrong. Please try again.');
                    }
                });
            });
        });

        $(".edit-modal-button").click(function(){
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
            $("input[name=target]").val(oldData.id);
            $("input[name=name]").val(oldData.name);
            $("input[name=code]").val(oldData.code);
            $("select[name=direction]").val(oldData.direction);
        });

        $(document).on('click', '.delete-btn', function(e) {
            let method = 'POST';
            let url = "{{ route('admin.languages.delete') }}";
            let title = 'Delete Language';
            let message = "Are Your Sure To Delete Language?";
            let target = $(this).data('target');
            alertModalShow(method, url, title, message, target);
        });
</script>
@endpush
