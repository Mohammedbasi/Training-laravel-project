@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Items',
    'baseBread'=>'Items',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="single_name" value="{{ request('single_name') }}" placeholder="Name"
                   class="form-control mx-2"/>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control mx-2">
                <option value="">All</option>
                <option value="active" @selected(request('is_active') == 'active')>Active</option>
                <option value="inactive" @selected(request('is_active') == 'inactive')>In-active</option>
            </select>
        </div>
        <div class="form-group">
            <label>Brand</label>
            <select name="brand_id" class="form-control form-select mx-2">
                <option value="">All</option>
                @foreach($brands as $brand)
                    <option
                        value="{{ $brand->id }}" @selected(request('brand_id') == $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>Inventory</label>
            <select name="inventory_id" class="form-control form-select mx-2">
                <option value="">All</option>
                @foreach($inventories as $inventory)
                    <option
                        value="{{ $inventory->id }}" @selected(request('inventory_id') == $inventory->id)>{{ $inventory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Vendor</label>
            <select name="vendor_id" class="form-control form-select mx-2">
                <option value="">All</option>
                @foreach($vendors as $vendor)
                    <option
                        value="{{ $vendor->id }}" @selected(request('vendor_id') == $vendor->id)>{{ $vendor->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label> Over 50 </label>
            <input type="checkbox" class="form-check" name="item_50">
        </div>
        <button class="btn btn-dark mx-2">Filter</button>

    </form>

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
            <th colspan="2">Actions</th>
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

                <td>
                    <a href="{{ route('item.add-to-inventory',$item->id) }}" class="btn btn-sm btn-outline-primary">Add to inventory</a>
                </td>

                <td>
                    <a href="{{ route('items.edit',$item->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('items.destroy',$item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
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
