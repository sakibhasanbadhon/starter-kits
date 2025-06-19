<table class="table roles_table table-striped text-nowrap m-0">
    <thead>
        <tr>
            <th style="width: 5%">SL</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Slug') }}</th>
            <th>{{ __('Permission') }}</th>
            <th>{{ __('Created At') }}</th>
            <th style="width: 10%">{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($roles as $item)
            <tr>
                <td style="widtd: 5%">{{ $loop->index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    @if ($item->permissions->count() > 0)
                        <span class="badge badge-sm badge-success py-1 px-2 fs-3">{{ $item->permissions->count() }}</span>
                    @else
                        <span class="badge badge-sm badge-warning py-1 px-2 fs-3">{{ __('No Permission') }}</span>
                    @endif
                </td>
                <td>{{ $item->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('admin.manage-admins.roles.edit', $item->id) }}" title="Edit" class="action-btn"><i class="fas fa-edit"></i></a>
                    @if ($item->delatable == true)
                    <a href="javascript:void(0)" title="Delete" data-target="{{ $item->id }}" class="action-btn delete-btn action-danger mr-1"><i class="fas fa-trash-alt"></i></a>
                    @endif
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
