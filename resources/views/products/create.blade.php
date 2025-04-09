@extends('layouts.app')

@section('content')
 <div class="container mt-4">
    <h2>Add Product</h2>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
 </div>

 <div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
 </div>

 <div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control" required>
        <option value="">Select Category</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
 </div>

 <div class="mb-3">
    <label>Subcategory</label>
    <select name="subcategory_id" class="form-control" required>
        <option value="">Select Subcategory</option>
        @foreach($subcategories as $sub)
            <option value="{{ $sub->id }}" {{ old('subcategory_id', $product->subcategory_id ?? '') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
        @endforeach
    </select>
 </div>

 <div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
 </div>

 <div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}" required>
 </div>

 <div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    @if (!empty($product->image))

     <img src="{{ asset($product->image) }}" width="100">

    @endif
 </div>


 <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="1" {{ old('status', $product->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', $product->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
 </div>


        <button type="submit" class="btn btn-success">Create Product</button>
    </form>
 </div>
@endsection
