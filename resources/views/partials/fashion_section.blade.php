<div class="fashion_section py-5">
    <div class="container">
        <h1 class="fashion_taital mb-4">Fashion</h1>
        <div class="row">
            @forelse($fashionProducts as $product)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="box_main border p-3 rounded shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="shirt_text">{{ $product->name }}</h4>
                            <p class="price_text">
                                Price <span style="color: #262626;">₹{{ number_format($product->price, 2) }}</span>
                            </p>
                            <div class="tshirt_img text-center my-3">
                                @php
                                    $images = explode(',', $product->image);
                                @endphp
                                <img src="{{ asset($images[0]) }}" alt="{{ $product->name }}"
                                     style="height: 250px; width: 100%; object-fit: contain;">
                            </div>
                        </div>
                        
                        <form action="{{ url('add_cart', $product->id) }}" method="POST" style="display:inline;">
                          @csrf
                         <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No products found in the Fashion category.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
