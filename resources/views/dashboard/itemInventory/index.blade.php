@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>$item->name,
    'baseBread'=>'Items',
    'childBread'=>$item->name,
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])


    <form action="{{ route('item.store-in-inventory',$item->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Vendor</label>
            <select name="vendor_id" class="form-control form-select mx-2">
                @foreach($vendors as $vendor)
                    <option
                        value="{{ $vendor->id }}" @selected(request('vendor_id') == $vendor->id)>{{ $vendor->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Inventory</label>
            <select name="inventory_id" class="form-control form-select mx-2">
                @foreach($inventories as $inventory)
                    <option
                        value="{{ $inventory->id }}" @selected(request('inventory_id') == $inventory->id)>{{ $inventory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" min="1" name="quantity" value="{{ request('quantity') }}" placeholder="Quantity"
                   class="form-control mx-2"/>
        </div>

        <button class="btn btn-dark mx-2">Store</button>
    </form>
@endsection
