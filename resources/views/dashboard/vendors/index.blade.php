@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Vendors',
    'baseBread'=>'Vendors',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="email" name="email" value="{{ request('email') }}" placeholder="Email" class="form-control mx-2"/>
        <input type="text" name="name" value="{{ request('name') }}" placeholder="Name"
               class="form-control mx-2"/>
        <input type="text" name="phone" value="{{ request('phone') }}" placeholder="Phone"
               class="form-control mx-2"/>

        <select name="is_active" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('is_active') == 'active')>Active</option>
            <option value="inactive" @selected(request('is_active') == 'inactive')>In-active</option>
        </select>


        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Status</th>
            <th>Phone</th>
            <th>Created At</th>
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
                <td>{{ $vendor->created_at }}</td>
                <td>
                    <a href="{{ route('vendors.edit',$vendor->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('vendors.destroy',$vendor->id) }}" method="post">
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
    {{ $vendors->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
