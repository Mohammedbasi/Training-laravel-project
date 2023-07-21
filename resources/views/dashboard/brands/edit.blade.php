@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Edit Brand',
    'baseBread'=>'Brands',
    'childBread'=>'Edit Brand'
])
    <form method="post" action="{{ route('brands.update',$brand->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.brands._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
@endsection
