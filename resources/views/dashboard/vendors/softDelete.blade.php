@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Trashed Vendors',
    'baseBread'=>'Vendors',
    'childBread'=>'Trash'
])
        @include('layouts.alert',['type'=>'success'])
        @include('layouts.alert',['type'=>'info'])


        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id}}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->first_name }}</td>
                    <td>{{ $vendor->last_name }}</td>
                    <td>{{ $vendor->is_active==1?'Active':'Inactive' }}</td>
                    <td>{{ $vendor->phone }}</td>
                    <td>{{ $vendor->deleted_at }}</td>
                    <td>
                        <form action="{{ route('vendors.restore',$vendor->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('vendors.force-delete',$vendor->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No Vendors defined.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <form method="get" action="{{ route('vendors.index') }}">
            <button class="btn btn-primary mx-3">Back</button>
        </form>
        {{ $vendors->links()}}
        <!-- REQUIRED SCRIPTS -->
@endsection
