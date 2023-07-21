@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Trashed Brands',
    'baseBread'=>'Trashed Brands',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <table class="table">
        <thead>
        <tr>
            <th>Icon</th>
            <th>ID</th>
            <th>Name</th>
            <th>Notes</th>
            <th>Deleted AT</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($brands as $brand)
            <tr>
                <td> <img height="100" style="border-radius: 25% 25% 25% 25%;" width="100" src="{{ asset('storage/'.$brand->icon) }}"> </td>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->notes }}</td>
                <td>{{ $brand->deleted_at }}</td>
                <td>
                    <form action="{{ route('brands.restore',$brand->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('brands.force-delete',$brand->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Brands defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $brands->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
