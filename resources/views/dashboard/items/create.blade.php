@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'New Item',
    'baseBread'=>'Items',
    'childBread'=>'New item'
])
    <form class="" method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        @include('dashboard.items._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
@endsection


