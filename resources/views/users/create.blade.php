@extends('layouts.layout')

@section('content')

<form method="post" action="{{ route('store') }}">
    @csrf
   @include('layouts._form')
</form>
@endsection


