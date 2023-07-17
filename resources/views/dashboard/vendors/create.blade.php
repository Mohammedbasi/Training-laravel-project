@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'New Vendor',
    'baseBread'=>'Vendors',
    'childBread'=>'New Vendor'
])
    <form class="" method="post" action="{{ route('vendors.store') }}">
        @csrf
        @include('dashboard.vendors._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
@endsection


