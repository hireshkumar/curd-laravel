@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subcategory List</h2>
    <a href="{{ route('subcategories.create') }}" class="btn btn-success mb-2">Add Subcategory</a>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach($subcategories as $subcategory)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $subcategory->name }}</td>
            <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
            <td>{{ $subcategory->description }}</td>
            <td>{{ $subcategory->status ? 'Active' : 'Inactive' }}</td>
            <td>
                <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-sm btn-primary">Edit</a>
            
              <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</button>
              </form>
            </tr>
        </tr>
        @endforeach
    </table>
</div>
@endsection
