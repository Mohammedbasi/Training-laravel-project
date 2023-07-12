
<div class="form-group">
    <label for="">Username</label>
    <input type="text" name="username" value="{{ old('username',$user->username??'') }}" class="form-control @error('username') is-invalid @enderror" />
    @include('layouts.error',['field'=>'username'])
</div>
<div class="form-group">
    <label for="">Email</label>
    <input type="email" name="email" value="{{ old('email',$user->email??'') }}" class="form-control @error('email') is-invalid @enderror" />
    @include('layouts.error',['field'=>'email'])
</div>
<div class="form-group">
    <label for="">First Name</label>
    <input type="text" name="first_name" value="{{ old('first_name',$user->first_name??'') }}" class="form-control @error('first_name') is-invalid @enderror" />
    @include('layouts.error',['field'=>'first_name'])
</div>
<div class="form-group">
    <label for="">Last Name</label>
    <input type="text" name="last_name" value="{{ old('last_name',$user->last_name??'') }}" class="form-control @error('last_name') is-invalid @enderror" />
    @include('layouts.error',['field'=>'last_name'])
</div>
@if(!isset($showPass))
<div class="form-group">
    <label for="">Password</label>
    <input type="password" name="password" value="{{ old('password',$user->password??'') }}" class="form-control @error('password') is-invalid @enderror" />
    @include('layouts.error',['field'=>'password'])
</div>
<div class="form-group">
    <label for="">Password Confirmation</label>
    <input type="password" name="password_conf" value="{{ old('password_conf',$user->password??'') }}" class="form-control @error('password_conf') is-invalid @enderror" />
    @include('layouts.error',['field'=>'password_conf'])
</div>
@endif
@if(!isset($show))
<div class="form-group">
    <label for="">Status</label>
    <select name="is_active" class="form-control form-select">
        <option @selected(old('is_active',$user->is_active??'') == 0) value="0">Inactive</option>
        <option @selected(old('is_active',$user->is_active??'') == 1) value="1">Active</option>
    </select>
</div>
<div class="form-group">
    <label for="">Role</label>
    <select name="is_admin" class="form-control form-select">
        <option @selected(old('is_admin',$user->is_admin??'') == 0) value="0">User</option>
        <option @selected(old('is_admin',$user->is_admin??'') == 1) value="1">Admin</option>
    </select>
</div>
<div class="form-group">
    <x-primary-button >{{ $button_label??'Create' }}</x-primary-button>
</div>
@endif
