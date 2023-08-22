@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'New User',
    'baseBread'=>'Users',
    'childBread'=>'New User'
])
    <form class="" method="post" action="{{ route('user.store') }}">
        @csrf
        @include('layouts._form')
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
@endsection


