<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ old('name',$inventory->name??'') }}"
           class="form-control @error('name') is-invalid @enderror"/>
    @include('layouts.error',['field'=>'name'])
</div>


<div class="form-group">
    <label for="">City</label>
    <select name="city_id" class="form-control form-select">
        @foreach($cities as $city)
            <option
                value="{{ $city->id }}" @selected(old('city_id',$inventory->city_id??'') == $city->id)>{{ $city->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Vendors</label>
    <select name="vendors[]" multiple size="10" class="custom-select">
        @foreach($vendors as $vendor)
            <option class="mb-1" value="{{ $vendor->id }}"
                {{ in_array($vendor->id, old('vendors', [])) ? 'selected' : '' }}
                @if(in_array($vendor->id, $selectedVendors??[])) selected @endif >{{ $vendor->first_name . $vendor->last_name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Phone</label>
    <input type="text" name="phone" value="{{ old('phone',$inventory->phone??'') }}"
           class="form-control @error('phone') is-invalid @enderror"/>
    @include('layouts.error',['field'=>'phone'])
</div>

<div class="form-group">
    <label for="">Status</label>
    <select name="is_active" class="form-control form-select">
        <option @selected(old('is_active',$inventory->is_active??'') == 1) value="1">Active</option>
        <option @selected(old('is_active',$inventory->is_active??'') == 0) value="0">Inactive</option>
    </select>
</div>




