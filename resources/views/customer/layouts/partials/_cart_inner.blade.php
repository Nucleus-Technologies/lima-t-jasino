@if ($cart->isEmpty())
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-xl-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h3 class="card-title">Your cart is empty!</h3>
                    <hr>
                    <p class="card-text">You can fill it with outfits from our shop.</p>
                    @if (!Auth::check())
                        <p class="card-text">Already have an account?
                            <a href="{{ route('login') }}" class="text-bold"><u class="text-bold text-white">Login</u></a>
                            to see items in your cart.
                        </p>
                    @endif
                    <hr>
                    <a href="{{ route('outfit.shop') }}" class="btn btn-light text-uppercase">Let's go to the shop</a>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Outfit</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $line)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img src="{{ show_photo($line->outfit->outfitphotos->first()->filename) }}" alt="">
                                </div>
                                <div class="media-body">
                                    <h4>
                                        <a href="{{ route('outfit.show', $line->outfit->slug) }}">{{ $line->outfit->name }}</a>
                                    </h4>
                                    <p>Category: <span class="text-primary">{{ ucfirst($line->outfit->category) }}</span></p>
                                    <p>Type: <span class="text-primary">{{ $line->outfit->type->label }}</span></p>
                                    <p><span class="text-primary">{!! format_availibility($line->outfit->availibility) !!}</span></p>
                                    <hr>

                                    <div class="d-flex">
                                        <form class="form-add-to-wishlist" method="POST">
                                            @csrf

                                            <input type="hidden" name="outfit" value="{{ crypt_id($line->outfit->id) }}">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-add-to-wishlist {{ is_wished($line->outfit->id) ? 'active' : '' }}">
                                                {!! is_wished($line->outfit->id) ? '<i class="fas fa-heart"></i> Added to Wishlist' : '<i class="fas fa-heart"></i> Add to Wishlist' !!}
                                            </button>
                                        </form>

                                        <form class="form-cart-outfit ml-2" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="outfit" value="{{ crypt_id($line->outfit->id) }}">
                                            <input type="hidden" name="cart" value="{{ crypt_id($line->id) }}">
                                            <input type="hidden" name="quantity" value="{{ $line->quantity }}">

                                            <button type="button" class="btn btn-outline-danger btn-sm btn-remove-from-cart"><i class="lnr lnr-trash"></i> Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form class="product_count line-cart" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cart" value="{{ crypt_id($line->id) }}">

                                <input type="text" name="quantity" id="sst" maxlength="12" value="{{ $line->quantity }}" title="Quantity:" class="input-text qty">
                                <button class="increase items-count" type="button">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button class="reduced items-count" type="button">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <h5>@convert($line->outfit->price)</h5>
                        </td>
                        <td>
                            <h4>@convert($line->total_price)</h4>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>
                        <h4 class="mb-0">Subtotal</h4>
                    </td>
                    <td>
                        <h3 class="text-bold mb-0">@convert(subtotal())</h3>
                    </td>
                </tr>
                <tr class="out_button_area">
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>
                        <div class="checkout_btn_inner">
                            <a class="gray_btn" href="{{ route('outfit.shop') }}">Continue Shopping</a>
                            <a class="main_btn" href="{{ route('payment.checkout.address_details') }}">Proceed to checkout</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif
