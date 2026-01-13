@extends('admin.layouts.app')


@push('style')
    <style>
          .table-container {
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-edit {
            background-color: #e7f3ff;
            color: #007bff;
        }
        .btn-delete {
            background-color: #fde8e8;
            color: #dc3545;
        }
    </style>
@endpush



@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="container table-container">
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Active</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $item)
                        <tr>
                            <td>{{ $item->title->title }}</td>
                            <td>{{ $item->url }}</td>
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
                            <td>{{ $item->created_at->format('d, F, Y') }}</td>
                        </tr>
                    @empty
                        <td colspan="6">
                            @include('admin.includes.elements.empty-table')
                        </td>
                    @endforelse




                </tbody>
            </table>
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



    </script>
@endpush

