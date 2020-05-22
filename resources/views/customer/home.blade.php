@extends('customer.layouts.app', ['title' => 'Home'])

@section('banner')

    {{-- Banner Area --}}
    <section class="home_banner_area">
        <div class="overlay"></div>
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content row">
                    <div class="offset-lg-2 col-lg-8">
                        <h3 class="text-uppercase mb-0">Lima T Jasino</h3>
                        <hr>
                        <h2 class="text-uppercase text-white mb-3">Bespoke</h2>

                        <a class="white_bg_btn text-uppercase" href="{{ route('collection') }}">View Collection</a>
                        <a class="white_bg_btn inverse text-uppercase" href="{{ route('appointment.create') }}">Book an appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    @include('customer.layouts.partials._collection_pub')

    {{-- Hot Deals Area --}}
    <section class="hot_deals_area section_gap pt-0">
        <div class="row mr-0 ml-0">
            <div class="col-lg-6 p-0 hot_deal_col">
                <div class="hot_deal_box">
                    <div class="content">
                        <h2>Hot Deals for You, Men</h2>
                        <p class="mb-0">Let's see</p>
                    </div>
                    <a class="hot_deal_link" href="{{ route('collection.men') }}"></a>
                </div>
            </div>

            <div class="col-lg-6 p-0 hot_deal_col">
                <div class="hot_deal_box">
                    <div class="content">
                        <h2>Women, you deserves the Best</h2>
                        <p class="mb-0">Let's see</p>
                    </div>
                    <a class="hot_deal_link" href="{{ route('collection.women') }}"></a>
                </div>
            </div>

            <div class="col-12 p-0 hot_deal_col">
                <div class="hot_deal_box">
                    <div class="content">
                        <h2>The best for the happiest weddings, ever.</h2>
                        <p class="mb-0">Let's see</p>
                    </div>
                    <a class="hot_deal_link" href="{{ route('collection.weddings') }}"></a>
                </div>
            </div>
        </div>
    </section>

    {{-- Clients Logo Area --}}
    {{--  <section class="clients_logo_area">
        <div class="container-fluid">
            <div class="clients_slider owl-carousel">
                <div class="item">
                    <img src="{{ asset('customer/img/clients-logo/c-logo-1.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('customer/img/clients-logo/c-logo-2.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('customer/img/clients-logo/c-logo-3.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('customer/img/clients-logo/c-logo-4.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('customer/img/clients-logo/c-logo-5.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>  --}}

    {{-- Feature Product Area --}}
    <section class="feature_product_area section_gap mb-0 pb-0">
        <div class="main_box">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_title">
                        <h2>Men Outfits</h2>
                        <p>The recent ones who might surely interest you men; a little change of style for your good.</p>
                    </div>
                </div>
                <div class="row">
                    @if ($men_outfits->isEmpty())
                        <div class="alert alert-primary w-100" role="alert">
                            <strong>Info!</strong> No outfits available!
                        </div>
                    @else
                        @foreach ($men_outfits as $outfit)
                            @php
                                $path = $outfit->category .'/'. $outfit->type->label .'/'. $outfit->outfitphotos->first()->filename;
                            @endphp
                            <div class="col col1">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="{{ show_photo($path) }}" alt="">
                                        <div class="p_icon d-flex">
                                            <form class="form-add-to-wishlist" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                <button type="submit" class="btn-add-to-wishlist {{ is_wished($outfit->id) ? 'active' : '' }}">
                                                    {!! is_wished($outfit->id) ? '<i class="fas fa-heart"></i>' : '<i class="fas fa-heart"></i>' !!}
                                                </button>
                                            </form>

                                            <form class="form-add-to-cart ml-2" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-add-to-cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="{{ route('outfit.show', $outfit) }}">
                                        <h4>{{ $outfit->name }}</h4>
                                    </a>
                                    <h5>@convert($outfit->price)</h5>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Feature Product Area --}}
    <section class="feature_product_area section_gap">
        <div class="main_box">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_title">
                        <h2>Women Outfits</h2>
                        <p>The recent ones who might surely interest you women; a little change of style for your good.</p>
                    </div>
                </div>
                <div class="row">
                    @if ($women_outfits->isEmpty())
                        <div class="alert alert-primary w-100" role="alert">
                            <strong>Info!</strong> No outfits available!
                        </div>
                    @else
                        @foreach ($women_outfits as $outfit)
                            @php
                                $path = $outfit->category .'/'. $outfit->type->label .'/'. $outfit->outfitphotos->first()->filename;
                            @endphp
                            <div class="col col1">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="{{ show_photo($path) }}" alt="">
                                        <div class="p_icon d-flex">
                                            <form class="form-add-to-wishlist" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                <button type="submit" class="btn-add-to-wishlist {{ is_wished($outfit->id) ? 'active' : '' }}">
                                                    {!! is_wished($outfit->id) ? '<i class="fas fa-heart"></i>' : '<i class="fas fa-heart"></i>' !!}
                                                </button>
                                            </form>

                                            <form class="form-add-to-cart ml-2" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-add-to-cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="{{ route('outfit.show', $outfit) }}">
                                        <h4>{{ $outfit->name }}</h4>
                                    </a>
                                    <h5>@convert($outfit->price)</h5>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
