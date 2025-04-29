
<div class="jewellery_section">
    <div class="container">
        <h1 class="jewellery_taital">Jewellery</h1>
        <div class="jewellery_section_2">
            <div class="row">
                @forelse($jewelleryProducts as $product)
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="box_main">
                            <h4 class="shirt_text">{{ $product->name }}</h4>
                            <p class="price_text">Price <span style="color: #262626;">₹{{ number_format($product->price, 2) }}</span></p>
                            <div class="tshirt_img">
                                @php $images = explode(',', $product->image); @endphp
                                <img src="{{ asset($images[0]) }}" alt="{{ $product->name }}" style="height: 250px; object-fit: contain;">
                            </div>
                            <div class="btn_main">
                            <form action="{{ url('add_cart', $product->id) }}" method="POST" style="display:inline;">
                          @csrf
                         <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No products found in Jewellery category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>