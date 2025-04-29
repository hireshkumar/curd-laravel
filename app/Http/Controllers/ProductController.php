<?php


namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->get();
        return view('products.index', compact('products'));
    

    }

    public function create(Request $request) 
    {      
        $categories = Category::active()->get();
        $selectedCategory = $request->get('category_id');
        
        $subcategories = $selectedCategory
            ? Subcategory::where('category_id', $selectedCategory)->active()->get()
            : [];
    
        return view('products.create', compact('categories', 'subcategories', 'selectedCategory'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('images')) {
            $imagePaths = [];
            // dd("hello");
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $filename);
                $imagePaths[] = 'images/products/' . $filename;
            }
            $imgs = implode(',',$imagePaths);
            $data['image'] = $imgs; 
        
        }
        
        

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $subcategories = Subcategory::active()->get();
        return view('products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('images')) {
            $imagePaths = [];
        
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/products'), $filename);
                $imagePaths[] = 'images/products/' . $filename;
            }
            $data['image'] = $imagePaths; 

        
        }
        
        

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function showFashion()
 {
    
    $fashionCategoryId = Category::where('name', 'Fashion')->first()->id;

    $fashionProducts = Product::where('status', 1)
        ->where('category_id', $fashionCategoryId)
        ->latest()
        ->take(9)
        ->get();

    return view('fashion', compact('fashionProducts'));
 }

  
 public function showElectronics()
 {

     $electronicsCategoryId = Category::where('name', 'Electronics')->first()->id;
 
     $electronicsProducts = Product::where('status', 1)
                         ->where('category_id', $electronicsCategoryId)
                         ->latest()
                         ->take(9)
                         ->get();
 
     return view('electronic', compact('electronicsProducts'));
 }
 
 public function showJewellery()
 {
     
     $jewelleryCategoryId = Category::where('name', 'Jewellery')->first()->id;
 
     $jewelleryProducts = Product::where('status', 1)
                         ->where('category_id', $jewelleryCategoryId)
                         ->latest()
                         ->take(9)
                         ->get();
                    
     return view('jewellery', compact('jewelleryProducts'));
 }
  

 public function showHome()
 {
    $fashionProducts = Product::whereHas('category', function ($query) {
        $query->where('name', 'Fashion');
    })->where('status', 1)->latest()->take(9)->get();

    $electronicsProducts = Product::whereHas('category', function ($query) {
        $query->where('name', 'Electronics');
    })->where('status', 1)->latest()->take(9)->get();

    $jewelleryProducts = Product::whereHas('category', function ($query) {
       $query->where('name', 'Jewellery');
    })->where('status', 1)->latest()->take(9)->get();

    return view('home', compact('fashionProducts', 'electronicsProducts', 'jewelleryProducts'));
 }
 

 


 

}
