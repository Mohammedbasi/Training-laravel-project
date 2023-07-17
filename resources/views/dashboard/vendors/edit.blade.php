@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Edit Vendor',
    'baseBread'=>'Vendors',
    'childBread'=>'Edit Vendor'
])
    <form method="post" action="{{ route('vendors.update',$vendor->id) }}">
        @csrf
        @method('put')
        @include('dashboard.vendors._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
@endsection
