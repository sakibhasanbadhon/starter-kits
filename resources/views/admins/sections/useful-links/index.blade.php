@extends('admin.layouts.app')


@section('button-area')
   <div class="d-flex justify-content-end">

        <div class="link-area ml-3">
            @permission('create-role')
                <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus button-icon"></i> {{ __('Add New') }}</button>
            @endpermission
        </div>
   </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body p-0">
                    <div class="table-responsive user_table">
                        <table class="table table-striped text-nowrap m-0">
                            <thead>
                                <tr>
                                    <th>Page Name</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($useful_link as $item)
                                    <tr data-item="{{ json_encode($item) }}">
                                        <td>{{ @$item->title }} </td>
                                        <td>{{ Str::words(@$item->details, 10, '...') }} </td>
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
                                        <td>{{ @$item->created_at->diffForHumans() }}</td>

                                        <td>
                                        <td>
                                            <button href="{{ route('admin.manage-admins.edit', $item->id) }}" data-toggle="modal" data-target=".bd-example-modal-lg-edit" title="Edit" class="edit-modal-button action-btn"><i class="fas fa-edit"></i></button>
                                            <button title="Delete" data-target="{{ $item->id }}" class="action-btn delete-btn action-danger mr-1"><i class="fas fa-trash-alt"></i></button>

                                        </td>

                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        @include('admin.includes.elements.empty-table')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div><!-- /.card -->
        </div>
    </div>

    {{-- add Modal --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Add New Useful Link') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.useful-links.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ __('Page Name') }}</label>
                            <input type="text" class="form-control" name="title" id="name" placeholder="{{ __('Enter Page Name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Details') }}</label>
                            <textarea name="details" class="form-control"  id="" cols="30" rows="10" placeholder="Type Details"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Add New Useful Link') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.useful-links.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="target" value="{{ old('target') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ __('Page Name') }}</label>
                            <input type="text" class="form-control" name="title" id="name" placeholder="{{ __('Enter Page Name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Details') }}</label>
                            <textarea name="details" class="form-control"  id="" cols="30" rows="10" placeholder="Type Details"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
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
                    url: '{{ route('admin.pages.status.update') }}',
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
                    error: function () {
                        alert('Something went wrong. Please try again.');
                    }
                });
            });
        });


        $(".edit-modal-button").click(function(){
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));
            $("input[name=target]").val(oldData.id);
            $("input[name=title]").val(oldData.title);
            $("textarea[name=details]").val(oldData.details);

        });



    </script>
@endpush


