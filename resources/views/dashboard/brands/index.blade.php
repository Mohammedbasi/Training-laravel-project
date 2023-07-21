@extends('layouts.dashboard')

@section('content')
    @include('layouts.partials.titles',[
    'h1'=>'Brands',
    'baseBread'=>'Brands',
])
    @include('layouts.alert',['type'=>'success'])
    @include('layouts.alert',['type'=>'info'])

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="single_name" value="{{ request('single_name') }}" placeholder="Name"
               class="form-control mx-2"/>
        <input type="text" name="notes" value="{{ request('notes') }}" placeholder="Notes"
               class="form-control mx-2"/>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Icon</th>
            <th>ID</th>
            <th>Name</th>
            <th>Notes</th>
            <th>Created AT</th>
            <th>Updated At</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @php

            @endphp
        @forelse($brands as $brand)
            <tr>
                <td><img height="100" style="border-radius: 25% 25% 25% 25%;" width="100"
                         src="{{ asset('storage/'.$brand->icon) }}"></td>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->notes }}</td>
                <td>{{ $brand->created_at }}</td>
                <td>{{ $brand->updated_at }}</td>

                <td>
                    <a href="{{ route('brands.edit',$brand->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('brands.destroy',$brand->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No Brands defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $brands->withQueryString()->links()}}
    <!-- REQUIRED SCRIPTS -->
@endsection
