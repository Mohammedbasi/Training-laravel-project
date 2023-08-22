@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Edit User',
    'baseBread'=>'Users',
    'childBread'=>'Edit User'
])
    <form method="post" action="{{ route('user.update',$user->id) }}">
        @csrf
        @method('put')
        @include('layouts._form',['showPass'=>true])
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
@endsection
