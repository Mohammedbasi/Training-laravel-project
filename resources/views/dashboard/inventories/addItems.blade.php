@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Add Items',
    'baseBread'=>'Add Items',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ route('inventories.store-items',$inventory->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="item_ids">Choose items:</label>
            <select name="item_ids[]" multiple class="custom-select-lg form-control">
                @foreach ($items as $item)
                    <option
                        @if(in_array($item->id, $selectedItems)) selected @endif
                    value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantities">Quantities:</label><br>
            @foreach ($items as $item)
                <label for="quantity_{{ $item->id }}">{{ $item->name }}:</label>
                <input
                    value="{{ old('quantities.' . $item->id, isset($itemQuantities[$item->id]) ? $itemQuantities[$item->id] : '') }}"
                    type="number" min="1" name="quantities[{{ $item->id }}]"><br>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Store') }}</x-primary-button>
        </div>
    </form>
@endsection
