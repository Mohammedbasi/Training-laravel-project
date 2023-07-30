@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Cart',
    'baseBread'=>'cart',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])
    <div class="d-flex justify-content-center mb-4">
        <form action="{{ route('front.cart.clear') }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-outline-danger" type="submit">Clear Cart</button>
        </form>

        <a href="{{ route('purchase.history') }}" class="btn btn-outline-primary ml-3">Orders</a>


        <form action="{{ route('front.purchase-all') }}" method="post">
            @csrf
            <button class="btn btn-outline-success ml-3" type="submit">Purchase All</button>
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            @if(isset($cart[$item->id]))
                @php
                    $quantity = $cart[$item->id]['quantity'];
                @endphp
                <tr>
                    <td><img height="100" style="border-radius: 25% 25% 25% 25%;" width="100"
                             src="{{ asset('storage/'.$item->image) }}"></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->brand->name }}</td>
                    <td>{{ $item->is_active==1?'Active':'Inactive' }}</td>
                    <td>{{ $quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->price * $quantity }}</td>
                    <td>
                        <form action="{{ route('front.purchase-single',$item->id) }}" method="post">
                            @csrf
                            <button class="btn btn-outline-success" type="submit">Purchase</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('front.cart.remove',$item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="6">No Items defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $items->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
