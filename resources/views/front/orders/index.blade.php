@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Orders History',
    'baseBread'=>'Orders History',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])


    <table class="table">
        <thead>
        <tr>
{{--            <th>Image</th>--}}
            <th>Name</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Created At</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
{{--                <td><img height="100" style="border-radius: 25% 25% 25% 25%;" width="100"--}}
{{--                         src="{{ asset('storage/'.$order->item->image) }}"></td>--}}
                <td>{{ $order->item->name }}</td>
                <td>{{ $order->status == 1 ? 'Delivered':'In-progress'}}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->item->price * $order->quantity }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No Items defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $orders->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
