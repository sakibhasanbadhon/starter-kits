<table class="table table-striped text-nowrap m-0">
    <thead>
        <tr>
            <th> SL</th>
            <th> image </th>
            <th> Country </th>
            <th> Symbol </th>
            <th> Rate </th>
            <th> Status</th>
            <th> Created At </th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($currencies ?? [] as $item)
        <tr>
            <td style="width: 5%">{{ $loop->index + 1 }}</td>

            <td>
                <div class="client_name d-flex align-items-center">
                    <div class="client_img">
                        {!! $item->currencyImage !!}
                    </div>
                </div>
            </td>

            <td>{{ $item->country }} <br>{{ $item->code }}</td>

            <td>{{ $item->symbol }}</td>
            <td>1 USD = {{ display_amount($item->rate,$item->code) }}</td>
            <td>
                <span class="badge badge-sm py-1 px-2 fs-3 {{ $item->statusType['class'] }}">{{ $item->statusType['name'] }}</span>
            </td>
            <td>{{ $item->created_at->diffForHumans() }}</td>
            <td>
                <a href="{{ route('admin.currencies.edit', $item->id) }}" title="Edit" class="action-btn"><i class="fas fa-edit"></i></a>
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







@push("script")
<script>

</script>
@endpush