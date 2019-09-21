@extends('customer.layouts.app', ['title' => 'Our Collection'])

@section('banner')

    {{-- Banner Area --}}
    <section class="home_banner_area">
        <div class="overlay"></div>
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content row">
                    <div class="offset-lg-2 col-lg-8">
                        <h3>Our <br> Collection</h3> <hr>
                        <p class="mt-4">
                            Suits, Pants, Shirts, Skirts, Trousers, Coats, Ties and so more. <br>
                            Discover us!
                        </p>
                     </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    {{-- Hot Deals Area --}}
    <section class="collection-area section_gap">
        <div class="container-fluid">
            <div class="d-flex align-items-center collection-group">
                <div class="description">
                    <h1 class="text-uppercase">Hot Deals For Men.</h1>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                    <a href="{{ route('collection.men') }}"> <i class="far fa-eye"></i> Discover this collection</a>
                </div>

                <img src="{{ asset('customer/img/collection/men/5.jpg') }}" alt="collection-picture" class="picture">
            </div>

            <div class="d-flex align-items-center collection-group">
                <div class="description">
                    <h1 class="text-uppercase">Women deserves the Best.</h1>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                    <a href="{{ route('collection.women') }}"> <i class="far fa-eye"></i> Discover this collection</a>
                </div>

                <img src="{{ asset('customer/img/collection/women/9.jpg') }}" alt="collection-picture" class="picture">
            </div>

            <div class="d-flex align-items-center collection-group">
                <div class="description">
                    <h1 class="text-uppercase">The best for the happiest weddings.</h1>
                    <hr>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                    </p>
                    <a href="{{ route('collection.weddings') }}"> <i class="far fa-eye"></i> Discover this collection</a>
                </div>

                <img src="{{ asset('customer/img/collection/weddings/1.jpg') }}" alt="collection-picture" class="picture">
            </div>
        </div>
    </section>

@endsection
