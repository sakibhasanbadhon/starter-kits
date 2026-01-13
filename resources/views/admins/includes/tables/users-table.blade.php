<table class="table table-striped text-nowrap m-0">
    <thead>
        <tr>
            <th style="width: 5%">SL</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Created At') }}</th>
            <th style="width: 10%">{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $item)
            <tr>
                <td style="widtd: 5%">{{ $loop->index + 1 }}</td>
                <td>
                    <div class="client_name d-flex align-items-center">
                        <div class="client_img">
                            {!! $item->userImage !!}
                        </div>
                        <div class="client_info">
                            <a href="">
                                <p class="name">{{ $item->fullName }}</p>
                                <p class="email">{{ $item->email }}</p>
                            </a>
                        </div>
                    </div>
                </td>
                <td>{{ $item->phone ?? "N/A" }}</td>
                <td>
                    <span class="badge badge-sm py-1 px-2 fs-3 {{ $item->statusType['class'] }}">{{ $item->statusType['name'] }}</span>
                </td>
                <td>{{ $item->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('admin.manage-admins.user.details', $item->id) }}" title="Edit" class="action-btn"><i class="fas fa-edit"></i></a>
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
