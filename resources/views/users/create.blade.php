@extends('layouts.layout')

@section('content')
    <x-app-layout>
<form class="" method="post" action="{{ route('user.store') }}">
    @csrf
   @include('layouts._form')
</form>
    </x-app-layout>
@endsection


