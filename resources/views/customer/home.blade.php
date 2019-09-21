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
                        <h2 class="text-uppercase text-white mb-5">Bespoke</h2>

                        <p>
                            <strong>Cameroon Premium Tailor.</strong> <br>
                            As tailors, we offer outfits already designed and you also have the opportunity to order your own, as well as visit us by booking appointments.
                        </p>

                        <a class="white_bg_btn text-uppercase" href="{{ route('collection') }}">View Collection</a>
                        <a class="white_bg_btn inverse text-uppercase" href="{{ route('appointment.create') }}">Book an appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    {{-- Hot Deals Area --}}
    <section class="hot_deals_area section_gap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hot_deal_box">
                        <img class="img-fluid" src="{{ asset('customer/img/product/hot_deals/for-men.jpg') }}" alt="">
                        <div class="content">
                            <h2>Hot Deals for You, Men</h2>
                            <p>shop now</p>
                        </div>
                        <a class="hot_deal_link" href="{{ route('outfit.search', 'category/men') }}" onclick="event.preventDefault(); document.getElementById('men-form').submit();"></a>
                        <form id="men-form" action="{{ route('outfit.search') }}" method="GET" style="display: none;">
                            @csrf
                            <input type="hidden" name="prefix" value="category">
                            <input type="hidden" name="keyword" value="men">
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hot_deal_box">
                        <img class="img-fluid" src="{{ asset('customer/img/product/hot_deals/for-women.jpg') }}" alt="">
                        <div class="content">
                            <h2>Women, you deserves the Best</h2>
                            <p>shop now</p>
                        </div>
                        <a class="hot_deal_link" href="{{ route('outfit.search', 'category/women') }}" onclick="event.preventDefault(); document.getElementById('women-form').submit();"></a>
                        <form id="women-form" action="{{ route('outfit.search') }}" method="GET" style="display: none;">
                            @csrf
                            <input type="hidden" name="prefix" value="category">
                            <input type="hidden" name="keyword" value="women">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Clients Logo Area --}}
    <section class="clients_logo_area">
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
    </section>

    {{-- Feature Product Area --}}
    <section class="feature_product_area section_gap">
        <div class="main_box">
            <div class="container-fluid">
                <div class="row">
                    <div class="main_title">
                        <h2>New Outfits</h2>
                        <p>Those who are recent and who might interest you; a change of style will do you good.</p>
                    </div>
                </div>
                <div class="row">
                    @if ($outfits->isEmpty())
                        <div class="alert alert-primary w-100" role="alert">
                            <strong>Info!</strong> No outfits available!
                        </div>
                    @else
                        @foreach ($outfits as $outfit)
                            <div class="col col1">
                                <div class="f_p_item">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="{{ show_photo($outfit->outfitphotos->first()->filename) }}" alt="">
                                        <div class="p_icon d-flex">
                                            <form class="form-add-to-wishlist" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                <button type="submit" class="btn-add-to-wishlist {{ is_wished($outfit->id) ? 'active' : '' }}">
                                                    {!! is_wished($outfit->id) ? '<i class="fas fa-heart"></i>' : '<i class="lnr lnr-heart"></i>' !!}
                                                </button>
                                            </form>

                                            <form class="form-add-to-cart ml-2" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-add-to-cart">
                                                    <i class="lnr lnr-cart"></i>
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

                <div class="row">
                    <nav class="cat_page mx-auto" aria-label="Page navigation example">
                        {{ $outfits->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection
