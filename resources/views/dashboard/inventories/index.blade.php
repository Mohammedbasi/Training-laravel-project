@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Inventories',
    'baseBread'=>'Inventories',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="single_name" value="{{ request('single_name') }}" placeholder="Name"
               class="form-control mx-2"/>

        <select name="is_active" class="form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('is_active') == 'active')>Active</option>
            <option value="inactive" @selected(request('is_active') == 'inactive')>In-active</option>
        </select>

        <input type="text" name="phone" value="{{ request('phone') }}" placeholder="Phone"
               class="form-control mx-2"/>

        <select name="city_id" class="form-control form-select mx-2">
            <option value="">All</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" @selected(request('city_id') == $city->id)>{{ $city->name }}</option>
            @endforeach
        </select>

        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th colspan="3">Actions</th>
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
                <td>{{ $inventory->created_at }}</td>
                <td>{{ $inventory->updated_at }}</td>

                <td>
                    <a href="{{ route('inventories.add-items',$inventory->id) }}"
                       class="btn btn-sm btn-outline-primary">Add Items</a>
                </td>

                <td>
                    <a href="{{ route('inventories.edit',$inventory->id) }}"
                       class="btn btn-sm btn-outline-success">Edit</a>
                </td>

                <td>
                    <form action="{{ route('inventories.destroy',$inventory->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No Inventories defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $inventories->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
