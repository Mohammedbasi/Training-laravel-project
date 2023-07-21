@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'New Brand',
    'baseBread'=>'Brands',
    'childBread'=>'New brand'
])
    <form class="" method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
        @csrf
        @include('dashboard.brands._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
@endsection


