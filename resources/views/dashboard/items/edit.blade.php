@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Edit Item',
    'baseBread'=>'Items',
    'childBread'=>'Edit Item'
])
    <form method="post" action="{{ route('items.update',$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.items._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
@endsection
