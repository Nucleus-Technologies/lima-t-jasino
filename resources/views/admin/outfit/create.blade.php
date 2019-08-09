@php
    $title = 'New Outfit'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="display-2 text-white">Register a new outfit.</h1>
                <p class="text-white mt-0 mb-5">On this page, you can register an outfit with all his components and properties.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row mt-5">

            <div class="col-lg-12 mb-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Outfit Registration</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.outfit.store') }}" class="outfit-save-form" enctype="multipart/form-data">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Simple information</h6>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('name') has-danger @enderror">
                                        <label class="form-control-label" for="input-name">Name</label>
                                        <input type="text" name="name" class="form-control form-control-alternative" id="input-name" placeholder="ex. Faded SkyBlu Denim Jeans" value="{{ old('name') }}" required>

                                        @error('name')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('price') has-danger @enderror">
                                        <label class="form-control-label" for="input-price">Price</label>
                                        <input type="number" name="price" class="form-control form-control-alternative" id="input-price" placeholder="ex. Faded SkyBlu Denim Jeans" value="{{ old('price') }}" min="0" required>

                                        @error('price')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('category') has-danger @enderror">
                                        <label class="form-control-label" for="input-category">Category</label><br>
                                        <div class="custom-control custom-control-alternative custom-radio mb-3">
                                            <input name="category" class="custom-control-input" type="radio" value="men" id="categoryRadio1" required>
                                            <label class="custom-control-label" for="categoryRadio1">Men</label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-radio mb-3">
                                            <input name="category" class="custom-control-input" type="radio" value="women" id="categoryRadio2" required>
                                            <label class="custom-control-label" for="categoryRadio2">Women</label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-radio mb-3">
                                            <input name="category" class="custom-control-input" type="radio" value="children" id="categoryRadio3" required>
                                            <label class="custom-control-label" for="categoryRadio3">Children</label>
                                        </div>

                                        @error('category')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-control-label" for="input-type">Type</label>
                                    <select name="type" class="form-control form-control-alternative @error('type') has-danger @enderror" id="input-type" required>
                                        <option selected></option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->wording }}</option>
                                        @endforeach
                                    </select>

                                    @error('type')
                                        <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('availibility') has-danger @enderror">
                                        <label class="form-control-label" for="input-availibility">Availibility</label><br>
                                        <div class="custom-control custom-control-alternative custom-radio mb-3">
                                            <input name="availibility" class="custom-control-input" type="radio" value="in" id="availibilityRadio1" required>
                                            <label class="custom-control-label" for="availibilityRadio1">In Stock</label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-radio mb-3">
                                            <input name="availibility" class="custom-control-input" type="radio" value="out" id="availibilityRadio2" required>
                                            <label class="custom-control-label" for="availibilityRadio2">Out of Stock</label>
                                        </div>

                                        @error('availibility')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('context') has-danger @enderror">
                                        <label class="form-control-label" for="input-context">Context</label><br>
                                        <textarea name="context" class="form-control form-control-alternative @error('context') is-invalid @enderror" rows="3" placeholder="Write a large text here..." id="input-context" required></textarea>

                                        @error('context')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('description') has-danger @enderror">
                                        <label class="form-control-label" for="input-description">Description</label><br>
                                        <textarea name="description" class="form-control form-control-alternative @error('description') is-invalid @enderror" rows="8" placeholder="Write the largest text here..." id="input-description" required></textarea>

                                        @error('description')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('photos') has-danger @enderror">
                                        <label class="form-control-label" for="input-photos">Outfit Photos</label><br>
                                        <div class="custom-file">
                                            <input type="file" name="photos[]" class="custom-file-input" id="input-photos" multiple>
                                            <label class="custom-file-label" for="input-photos">Choose one/many file(s)</label>
                                        </div>

                                        @error('photos')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-outfit-save"><i class="fas fa-check-circle"></i> SAVE THIS OUTFIT</button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group @error('specification') has-danger @enderror">
                                        <label class="form-control-label" for="input-specification">Specification</label><br>
                                        <div class="alert alert-default">
                                            <p>
                                                <span class="badge badge-pill badge-secondary"> <i class="fas fa-exclamation-triangle"></i> IMPORTANT</span>
                                            </p>
                                            Defines this outfit specification in this format: <strong>wording 1:value 1|wording 2:value 2|...</strong><br>
                                            For example: <strong>Width:128mm|Height:508mm|Depth:85mm</strong>
                                        </div>
                                        <textarea name="specification" class="form-control form-control-alternative @error('specification') is-invalid @enderror" rows="9" placeholder="Write the largest text here..." id="input-specification" required></textarea>

                                        @error('specification')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
