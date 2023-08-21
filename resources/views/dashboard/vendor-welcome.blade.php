@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Welcome message',
    'baseBread'=>'Welcome Message',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ route('vendor.welcome.send') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"/>
            @include('layouts.error',['field'=>'email'])
        </div>
        <button class="btn btn-success">Send</button>
    </form>
@endsection
