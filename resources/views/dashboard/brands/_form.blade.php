
<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ old('name',$brand->name??'') }}" class="form-control @error('name') is-invalid @enderror" />
    @include('layouts.error',['field'=>'name'])
</div>

<div class="form-group">
    <label for="">Notes</label>
    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes',$brand->notes??'') }}</textarea>
    @include('layouts.error',['field'=>'notes'])
</div>

<div class="form-group">
    <label for="">Icon</label>
    <input type="file" name="icon" value="{{ old('icon',$brand->icon??'') }}" class="form-control @error('icon') is-invalid @enderror" />
    @include('layouts.error',['field'=>'icon'])
    @if(isset($brand->icon))
        <img height="100" width="100" src="{{ asset('storage/'.$brand->icon) }}" alt="">
    @endif
</div>



