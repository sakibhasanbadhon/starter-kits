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


        @forelse ($currencies ?? [] as $item)
            <tr data-item="{{ $item->editData }}">
                <td>
                    <ul class="user-list">
                        <li><img src="{{ get_image($item->flag,'currency-flag') }}" alt="flag"></li>
                    </ul>
                </td>
                <td>{{ $item->name }}
                    @if ($item->default)
                        <span class="badge badge--success ms-1">{{ __("Default") }}</span>
                    @endif
                    <br> <span>{{ $item->code }}</span></td>
                <td>{{ $item->symbol }}</td>
                <td>1 {{ get_default_currency_code($default_currency) }} = {{ get_amount($item->rate,$item->code) }}</td>
                <td>
                    @include('admin.components.form.switcher',[
                        'name'          => 'currency_status',
                        'value'         => $item->status,
                        'options'       => [__('Enable') => 1,__('Disable') => 0],
                        'onload'        => true,
                        'data_target'   => $item->code,
                        'permission'    => "admin.currency.status.update",
                    ])
                </td>
                <td>
                    @include('admin.components.link.edit-default',[
                        'href'          => "javascript:void(0)",
                        'class'         => "edit-modal-button",
                        'permission'    => "admin.currency.update",
                    ])
                    @if (!$item->isDefault())
                        @include('admin.components.link.delete-default',[
                            'href'          => "javascript:void(0)",
                            'class'         => "delete-modal-button",
                            'permission'    => "admin.currency.delete",
                        ])
                    @endif
                </td>
            </tr>
        @empty
            @include('admin.components.alerts.empty',['colspan' => 7])
        @endforelse




        {{-- @forelse ($users as $item)
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
        @endforelse --}}



    </tbody>
</table>





<table class="custom-table currency-search-table">
    <thead>
        <tr>
            <th></th>
            <th>{{ __("Name") }} | {{ __("Code") }}</th>
            <th>{{ __("Symbol") }}</th>
            <th>{{ __("Type") }} | {{ __("Rate") }}</th>
            <th>{{ __("Role") }}</th>
            <th>{{ __("Status") }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($currencies ?? [] as $item)
            <tr data-item="{{ $item->editData }}">
                <td>
                    <ul class="user-list">
                        <li><img src="{{ get_image($item->flag,'currency-flag') }}" alt="flag"></li>
                    </ul>
                </td>
                <td>{{ $item->name }}
                    @if ($item->default)
                        <span class="badge badge--success ms-1">{{ __("Default") }}</span>
                    @endif
                    <br> <span>{{ $item->code }}</span></td>
                <td>{{ $item->symbol }}</td>
                <td>1 {{ get_default_currency_code($default_currency) }} = {{ get_amount($item->rate,$item->code) }}</td>
                <td>
                    @include('admin.components.form.switcher',[
                        'name'          => 'currency_status',
                        'value'         => $item->status,
                        'options'       => [__('Enable') => 1,__('Disable') => 0],
                        'onload'        => true,
                        'data_target'   => $item->code,
                        'permission'    => "admin.currency.status.update",
                    ])
                </td>
                <td>
                    @include('admin.components.link.edit-default',[
                        'href'          => "javascript:void(0)",
                        'class'         => "edit-modal-button",
                        'permission'    => "admin.currency.update",
                    ])
                    @if (!$item->isDefault())
                        @include('admin.components.link.delete-default',[
                            'href'          => "javascript:void(0)",
                            'class'         => "delete-modal-button",
                            'permission'    => "admin.currency.delete",
                        ])
                    @endif
                </td>
            </tr>
        @empty
            @include('admin.components.alerts.empty',['colspan' => 7])
        @endforelse
    </tbody>
</table>

@push("script")
    <script>
        $(document).ready(function(){
            // Switcher
            switcherAjax("{{ setRoute('admin.currency.status.update') }}");
        })
    </script>
@endpush
