@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Users',
    'baseBread'=>'Users',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="username" value="{{ request('username') }}" placeholder="Username"
               class="form-control mx-2"/>
        <input type="email" name="email" value="{{ request('email') }}" placeholder="Email" class="form-control mx-2"/>
        <input type="text" name="name" value="{{ request('name') }}" placeholder="Name"
               class="form-control mx-2"/>

        <select name="is_active" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('is_active') == 'active')>Active</option>
            <option value="inactive" @selected(request('is_active') == 'inactive')>In-active</option>
        </select>

        <select name="is_admin" class="form-control mx-2">
            <option value="">All</option>
            <option value="admin" @selected(request('is_admin') == 'admin')>Admin</option>
            <option value="user" @selected(request('is_admin') == 'user')>User</option>
        </select>

        <button class="btn btn-dark mx-2">Filter</button>
    </form>

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
                <td colspan="5">No categories defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $users->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
