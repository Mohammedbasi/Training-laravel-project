@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'New Inventory',
    'baseBread'=>'Inventories',
    'childBread'=>'New Inventory'
])
    <form class="" method="post" action="{{ route('inventories.store') }}" enctype="multipart/form-data">
        @csrf
        @include('dashboard.inventories._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
@endsection


