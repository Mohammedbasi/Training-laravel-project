@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Trashed Users',
    'baseBread'=>'Users',
    'childBread'=>'Trash'
])
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
                <th>Deleted At</th>
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
                    <td>{{ $user->deleted_at }}</td>
                    <td>
                        <form action="{{ route('user.restore',$user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('user.force-delete',$user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No Users defined.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <form method="get" action="{{ route('user.index') }}">
            <button class="btn btn-primary mx-3">Back</button>
        </form>
        {{ $users->links()}}
        <!-- REQUIRED SCRIPTS -->
@endsection
