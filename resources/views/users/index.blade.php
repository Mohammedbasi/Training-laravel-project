@extends('layouts.layout')

@section('content')
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <div>
        <a href="{{ route('create') }}" class="btn btn-primary mb-3 ml-3 mx-3">Create</a>
        <a href="{{ route('trash') }}" class="btn btn-dark mb-3 ml-3 mx-3">Trash</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Status</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id}}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->is_active==1?'Active':'Inactive' }}</td>
                <td>{{ $user->is_admin ==1?'Admin':'User' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a href="{{ route('edit',$user->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('delete',$user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No categories defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $users->links()}}
    <!-- REQUIRED SCRIPTS -->

@endsection
