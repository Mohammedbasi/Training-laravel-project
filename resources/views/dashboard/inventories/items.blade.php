@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Items',
    'baseBread'=>'Items',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Status</th>
            <th>Price</th>
            <th>Purchasable</th>
            <th>Purchases</th>
            <th>Sales</th>
{{--            <th colspan="2">Actions</th>--}}
        </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td><img height="100" style="border-radius: 25% 25% 25% 25%;" width="100"
                         src="{{ asset('storage/'.$item->image) }}"></td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->brand->name }}</td>
                <td>{{ $item->is_active==1?'Active':'Inactive' }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->purchasable == 1 ? 'Purchasable':'Not Purchasable' }}</td>
                <td>{{ $item->total_purchases }}</td>
                <td>{{ $item->total_sales }}</td>

{{--                <td>--}}
{{--                    <a href="{{ route('item.add-to-inventory',$item->id) }}" class="btn btn-sm btn-outline-primary">Add to inventory</a>--}}
{{--                </td>--}}

{{--                <td>--}}
{{--                    <a href="{{ route('items.edit',$item->id) }}" class="btn btn-sm btn-outline-success">Edit</a>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <form action="{{ route('items.destroy',$item->id) }}" method="post">--}}
{{--                        @csrf--}}
{{--                        @method('delete')--}}
{{--                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @empty
            <tr>
                <td colspan="9">No Items defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $items->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
