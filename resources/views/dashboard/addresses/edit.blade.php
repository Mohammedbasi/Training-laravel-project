@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Edit Address',
    'baseBread'=>'Address',
    'childBread'=>'Edit Address'
])
    <form method="post"
          action="{{ $type =='user'?route('user.address.update',$role->id):route('vendors.address.update',$role->id) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">City</label>
            <select name="city_id" class="form-select form-control">
                @foreach($cities as $city)
                    <option
                        @selected(old('city_id',$role->address->city_id??'')== $city->id) value="{{ $city->id }}"> {{ $city->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">District</label>
            <input type="text" name="district" value="{{ old('district',$role->address->district??'') }}"
                   class="form-control @error('district') is-invalid @enderror"/>
            @include('layouts.error',['field'=>'district'])
        </div>

        <div class="form-group">
            <label for="">Street</label>
            <input type="text" name="street" value="{{ old('street',$role->address->street??'') }}"
                   class="form-control @error('street') is-invalid @enderror"/>
            @include('layouts.error',['field'=>'street'])
        </div>

        <div class="form-group">
            <label for="">Phone</label>
            <input type="text" name="phone" value="{{ old('phone',$role->address->phone??'') }}"
                   class="form-control @error('phone') is-invalid @enderror"/>
            @include('layouts.error',['field'=>'phone'])
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
@endsection
