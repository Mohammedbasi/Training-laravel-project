
<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ old('name',$item->name??'') }}" class="form-control @error('name') is-invalid @enderror" />
    @include('layouts.error',['field'=>'name'])
</div>


<div class="form-group">
    <label for="">Brand</label>
    <select name="brand_id" class="form-control form-select">
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @selected(old('brand_id',$item->brand_id??'') == $brand->id)>{{ $brand->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Status</label>
    <select name="is_active" class="form-control form-select">
        <option @selected(old('is_active',$item->is_active??'') == 1) value="1">Active</option>
        <option @selected(old('is_active',$item->is_active??'') == 0) value="0">Inactive</option>
    </select>
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" value="{{ old('image',$item->image??'') }}" class="form-control @error('image') is-invalid @enderror" />
    @include('layouts.error',['field'=>'image'])
    @if(isset($item->image))
        <img height="100" width="100" src="{{ asset('storage/'.$item->image) }}" alt="">
    @endif
</div>



