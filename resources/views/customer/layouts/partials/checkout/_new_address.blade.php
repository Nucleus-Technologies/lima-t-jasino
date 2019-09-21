<h3>Defines a new address.</h3>

<form class="row ml-0 mr-0 address-details-form" action="{{ route('payment.checkout.address_details.store') }}" method="POST">
    @csrf

    <div class="ordering_zone col-12 mt-3 mb-4">
        <div class="row">
            <h3 class="col-12">Ordering Zone</h3>

            <div class="col-12 form-group d-flex flex-column flex-sm-row">
                <div class="radion_btn">
                    <input type="radio" id="national" name="zone" class="zone" value="national" checked>
                    <label for="national">National </label>
                    <div class="check"></div>
                </div>
                {{--  <div class="radion_btn">
                    <input type="radio" id="international" name="zone" class="zone" value="international">
                    <label for="international">International </label>
                    <div class="check"></div>
                </div>  --}}

                @error('zone')
                    <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="billing_details col-12" id="address_details">
        @include('customer.layouts.partials.checkout._national_details')
    </div>
</form>
