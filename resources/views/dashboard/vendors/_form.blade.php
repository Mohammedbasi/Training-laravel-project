
<div class="form-group">
    <label for="">Email</label>
    <input type="email" name="email" value="{{ old('email',$vendor->email??'') }}" class="form-control @error('email') is-invalid @enderror" />
    @include('layouts.error',['field'=>'email'])
</div>

<div class="form-group">
    <label for="">First Name</label>
    <input type="text" name="first_name" value="{{ old('first_name',$vendor->first_name??'') }}" class="form-control @error('first_name') is-invalid @enderror" />
    @include('layouts.error',['field'=>'first_name'])
</div>
<div class="form-group">
    <label for="">Last Name</label>
    <input type="text" name="last_name" value="{{ old('last_name',$vendor->last_name??'') }}" class="form-control @error('last_name') is-invalid @enderror" />
    @include('layouts.error',['field'=>'last_name'])
</div>

<div class="form-group">
    <label for="">Phone</label>
    <input type="text" name="phone" value="{{ old('phone',$vendor->phone??'') }}" class="form-control @error('phone') is-invalid @enderror" />
    @include('layouts.error',['field'=>'phone'])
</div>

<div class="form-group">
    <label for="">Status</label>
    <select name="is_active" class="form-control form-select">
        <option @selected(old('is_active',$vendor->is_active??'') == 0) value="0">Inactive</option>
        <option @selected(old('is_active',$vendor->is_active??'') == 1) value="1">Active</option>
    </select>
</div>

