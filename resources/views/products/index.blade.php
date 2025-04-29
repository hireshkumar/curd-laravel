@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Product List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Sku</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr> 
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td> 
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>{{ $product->subcategory->name ?? '-' }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <?php
                $imgs = $product->image;
                $img = explode(',',$imgs);
                // dd($img);
                ?>
                <td><img src="{{ asset($img[0]) }}" width="100"></td>


                <td>
                    <span class="badge bg-{{ $product->status ? 'success' : 'danger' }}">
                        {{ $product->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="d-inline-block" onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8">No products found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
