@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Trashed Items',
    'baseBread'=>'Trashed Items',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Status</th>
            <th>Deleted AT</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($items as $item)
            <tr>
                <td> <img height="100" style="border-radius: 25% 25% 25% 25%;" width="100" src="{{ asset('storage/'.$item->image) }}"> </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->brand->name }}</td>
                <td>{{ $item->is_active }}</td>
                <td>{{ $item->deleted_at }}</td>
                <td>
                    <form action="{{ route('items.restore',$item->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('items.force-delete',$item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No Items defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $items->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
