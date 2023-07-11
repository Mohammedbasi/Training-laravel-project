@extends('layouts.layout')

@section('content')

<form method="post" action="{{ route('update',$user->id) }}">
    @csrf
    @method('put')
    @include('layouts._form',[
    'button_label'=>'Update'
])
</form>

@endsection
