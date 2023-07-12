@extends('layouts.layout')

@section('content')
    <x-app-layout>

    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

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
                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('user.delete',$user->id) }}" method="post">
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
    </x-app-layout>
@endsection
