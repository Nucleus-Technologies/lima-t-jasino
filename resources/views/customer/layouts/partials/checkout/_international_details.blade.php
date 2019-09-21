<div class="row contact_form">

    <h3 class="col-12">Address Details</h3>

    <div class="col-md-6 form-group p_star">
        <label for="first_name">First name </label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') ?: Auth::user()->first_name }}" required>
        @error('first_name')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="last_name">Last name </label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') ?: Auth::user()->last_name }}" required>
        @error('last_name')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="email">Email Address </label>
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?: Auth::user()->email }}" required>
        @error('email')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="country">Country </label>
        <select name="country" class="custom-select" id="country" required>
            @foreach ($countries as $country)
            <option value="{{ $country }}">{{ $country }}</option>
            @endforeach
        </select>
        @error('country')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="phone1">Phone number 01 </label>
        <input type="phone" class="form-control" id="phone1" name="phone1" value="{{ old('phone1') ?: Auth::user()->phone }}" pattern="[\+][0-9]{6,}" placeholder="ex. +237655191890" required>
        @error('phone1')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        <label for="phone2">Phone number 02 </label>
        <input type="phone" class="form-control" id="phone2" name="phone2" value="{{ old('phone2') }}" pattern="[\+][0-9]{6,}" placeholder="ex. +237655191890">
        @error('phone2')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="addressline1">Address line 01 </label>
        <input type="text" class="form-control" id="addressline1" name="addressline1" value="{{ old('addressline1') }}" placeholder="Street / Apartment / Suite / Block / Building" required>
        @error('addressline1')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        <label for="addressline2">Address line 02 </label>
        <input type="text" class="form-control" id="addressline2" name="addressline2" value="{{ old('addressline2') }}" placeholder="Street / Apartment / Suite / Block / Building">
        @error('addressline2')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="region">Region </label>
        <input type="text" class="form-control" id="region" name="region" value="{{ old('region') }}" required>
        @error('region')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="city">Town/City </label>
        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
        @error('city')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        <label for="zip">Postcode/ZIP </label>
        <input type="number" class="form-control" id="zip" name="zip" value="{{ old('zip') }}">
        @error('zip')
            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="col-md-12 checkout_btn_inner mt-4 mb-4">
        <button type="submit" class="main_btn text-uppercase" id="btn-save-details">
            Save the details
        </button>
    </div>
</div>
