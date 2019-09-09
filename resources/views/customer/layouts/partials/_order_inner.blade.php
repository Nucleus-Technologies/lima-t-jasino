<div class="order_box">
    <h2>Your Order</h2>

    <ul class="list">
        <li>
            <span class="first">Product</span>
            <span class="last">Total</span>
        </li>

        @foreach ($cart as $line)
            <li>
                <span class="first">{{ cart_outfit($line->outfit)->name }}
                    <br> <small class="text-primary">@convert(cart_outfit($line->outfit)->price)</small>
                </span>
                <span class="middle">x {{ $line->quantity }}</span>
                <span class="last">@convert(total_price($line->outfit, $line->quantity))</span>
            </li>
        @endforeach
    </ul>

    <ul class="list list_2">
        <li>
            <span class="first">Subtotal</span>
            <span class="last">@convert(subtotal())</span>
        </li>
        <li>
            <span class="first">Shipping</span>
            <span class="last">Flat rate: $50.00</span>
        </li>
        <li>
            <span class="first">Total</span>
            <span class="last">$2210.00</span>
        </li>
    </ul>
</div>
