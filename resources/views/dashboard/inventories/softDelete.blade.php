@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Trashed Inventories',
    'baseBread'=>'Trashed Inventories',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Deleted At</th>

            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>

        @forelse($inventories as $inventory)
            <tr>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->city->name }}</td>
                <td>{{ $inventory->phone }}</td>
                <td>{{ $inventory->is_active == 1 ?'Active':'Inactive' }}</td>
                <td>{{ $inventory->deleted_at }}</td>
                <td>
                    <form action="{{ route('inventories.restore',$inventory->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('inventories.force-delete',$inventory->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No Inventories defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $inventories->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
