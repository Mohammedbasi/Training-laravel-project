@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Edit Inventory',
    'baseBread'=>'Inventories',
    'childBread'=>'Edit Inventory'
])
    <form method="post" action="{{ route('inventories.update',$inventory->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.inventories._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
@endsection
