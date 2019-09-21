<div class="order_box">
    <h2>Your Order</h2>

    <ul class="list">
        <li>
            <span class="first">Product</span>
            <span class="last">Total</span>
        </li>

        @foreach ($cart as $line)
            <li>
                <span class="first" title="{{ $line->outfit->name }}">{{ format_message($line->outfit->name, 35) }}
                    <br> <small class="text-primary">@convert($line->outfit->price)</small>
                </span>
                <span class="middle">x {{ show2digits($line->quantity) }}</span>
                <span class="last">@convert($line->total_price)</span>
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
            <span class="last" id="order-shipping-cost">@convert(shipping_cost(isset($relayPoint) ? $relayPoint->id : null))</span>
        </li>
        <li>
            <span class="first">Total</span>
            <span class="last" id="order-total">@convert(total(isset($relayPoint) ? $relayPoint->id : null))</span>
        </li>
    </ul>
</div>
