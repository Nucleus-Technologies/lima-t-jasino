<div class="row">
    <div class="col-lg-8">
        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
            <h3 class="col-12">Billing Details</h3>
            <div class="col-md-6 form-group p_star">
                <label for="first_name">First name </label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="last_name">Last name </label>
                <input type="text" class="form-control" id="last_name" name="name_name" value="{{ $user->last_name }}">
            </div>
            <div class="col-md-12 form-group p_star">
                <label for="email">Email Address </label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="col-md-12 form-group p_star">
                <label for="country_select">Country </label>
                <select name="country" class="country_select" id="country_select">
                    <option value="Cameroon" selected>Cameroon</option>
                </select>
            </div>
            <div class="col-md-6 form-group p_star">
                <label for="phone">Phone number 01 </label>
                <input type="phone" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" pattern="+\[0-9+]{}">
            </div>
            <div class="col-md-6 form-group">
                <label for="phone2">Phone number 02 </label>
                <input type="phone" class="form-control" id="phone2" name="phone2" pattern="+\[0-9+]{}">
            </div>
            <div class="col-md-12 form-group p_star">
                <label for="address1">Address line 01 </label>
                <input type="text" class="form-control" id="address1" name="address1">
            </div>
            <div class="col-md-12 form-group">
                <label for="address2">Address line 02 </label>
                <input type="text" class="form-control" id="address2" name="address2">
            </div>
            <div class="col-md-12 form-group p_star">
                <label for="region">Region </label>
                <input type="text" class="form-control" id="region" name="region">
            </div>
            <div class="col-md-12 form-group p_star">
                <label for="town_city">Town/City </label>
                <input type="text" class="form-control" id="town_city" name="town_city">
            </div>
        </form>
    </div>

    <div class="col-lg-4">
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
            <div class="payment_item">
                <div class="radion_btn">
                    <input type="radio" id="cash-on-delivery" name="payment_mode" value="cash-on-delivery">
                    <label for="cash-on-delivery">Cash on delivery</label>
                    <img src="{{ asset('customer/img/product/payment-mode/cash-on-delivery.jpg') }}" alt="">
                    <div class="check"></div>
                </div>
                <p>You will pay all the costs related to your order and delivery when receiving it on delivery.</p>
            </div>
            <div class="payment_item">
                <div class="radion_btn">
                    <input type="radio" id="orange-money" name="payment_mode" value="orange-money">
                    <label for="orange-money">Orange Money </label>
                    <img src="{{ asset('customer/img/product/payment-mode/orange-money.png') }}" alt="">
                    <div class="check"></div>
                </div>
            </div>
            <div class="payment_item">
                <div class="radion_btn">
                    <input type="radio" id="momo" name="payment_mode" value="momo">
                    <label for="momo">MTN Mobile Money </label>
                    <img src="{{ asset('customer/img/product/payment-mode/mtn-mobile-money.jpg') }}" alt="">
                    <div class="check"></div>
                </div>
            </div>
            <div class="creat_account mt-4">
                <input type="checkbox" id="f-option4" name="selector">
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms & conditions*</a>
            </div>
            <a class="main_btn" href="#">Proceed to Paypal</a>
        </div>
    </div>
</div>
