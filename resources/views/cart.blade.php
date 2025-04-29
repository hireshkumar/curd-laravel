@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Your Cart</h2>
    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                @php
                    $product = $item->product;
                    $subtotal = $product->price * $item->quantity;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                    <!-- ye product ki image show kar rha hai cart mai -->
                                <?php
                                    $allImages = explode(',', $product->image);
                                    $firstImage = $allImages[0];
                                ?>
                                <img src="{{ asset($firstImage) }}" width="80" height="100" class="img-thumbnail" alt="{{ $product->name }}">
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $product->name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td>₹{{ $product->price }}</td>
                    <td>
                             <!-- yaha increase or decrease ke button hai  -->
                             
                      <button class="decrease-quantity btn btn-sm btn-danger" data-cart-id="{{ $item->id }}">-</button>
                       <span id="quantity-{{ $item->id }}">{{ $item->quantity }}</span>
                       <button class="increase-quantity btn btn-sm btn-success" data-cart-id="{{ $item->id }}">+</button>
                        
                   
                    </td>
                    <td class="text-center">₹<span id="total-{{ $item->id }}">{{ $subtotal }}</span></td>

                    <td>
    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> Remove
        </button>
    </form>
</td>

                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right">
                    <h3><strong>Total ₹<span id="total_cart">{{ $total }}</span></strong></h3>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                      <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                      <a href="" class="btn btn-success"><i class="fa fa-credit-card"></i> Checkout</a>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    function updateCart(cartItemId, url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#quantity-' + cartItemId).text(response.newQuantity);
                    $('#total-' + cartItemId).text(response.totalPrice);
                    $('#cart-count').text(response.cartCount);

                   
                    let newCartTotal = 0;
                    $('.text-center span[id^="total-"]').each(function() {
                        newCartTotal += parseFloat($(this).text());
                    });
                    $('#total_cart').text(newCartTotal);
                }
            }
        });
    }

    $('.increase-quantity').click(function() {
        const cartItemId = $(this).data('cart-id');
        updateCart(cartItemId, '/cart/increase/' + cartItemId);
    });

    $('.decrease-quantity').click(function() {
        const cartItemId = $(this).data('cart-id');
        updateCart(cartItemId, '/cart/decrease/' + cartItemId);
    });
});


</script>

@endsection
