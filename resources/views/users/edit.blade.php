@extends('layouts.layout')

@section('content')
    <x-app-layout>
<form method="post" action="{{ route('user.update',$user->id) }}">
    @csrf
    @method('put')
    @include('layouts._form',[
    'button_label'=>'Update'
])
</form>
    </x-app-layout>
@endsection
