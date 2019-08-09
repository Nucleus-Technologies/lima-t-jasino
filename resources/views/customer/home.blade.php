@extends('customer.layouts.app', ['title' => 'Home'])

@section('banner')

    {{-- Banner Area --}}
    <section class="home_banner_area">
        <div class="overlay"></div>
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content row">
                    <div class="offset-lg-2 col-lg-8">
                        <h3>Fashion for
                            <br />Upcoming Winter</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                        <a class="white_bg_btn text-uppercase" href="#">View Collection</a>
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
                        <img class="img-fluid" src="{{ asset('customer/img/product/hot_deals/deal1.jpg') }}" alt="">
                        <div class="content">
                            <h2>Hot Deals of this Month</h2>
                            <p>shop now</p>
                        </div>
                        <a class="hot_deal_link" href="#"></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hot_deal_box">
                        <img class="img-fluid" src="{{ asset('customer/img/product/hot_deals/deal1.jpg') }}" alt="">
                        <div class="content">
                            <h2>Hot Deals of this Month</h2>
                            <p>shop now</p>
                        </div>
                        <a class="hot_deal_link" href="#"></a>
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
                    <div class="col col1">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-1.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                    <div class="col col2">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-2.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                    <div class="col col3">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-3.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                    <div class="col col4">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-4.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                    <div class="col col5">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-5.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>

                    <div class="col col6">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-5.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>

                    <div class="col col7">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-4.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>

                    <div class="col col8">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-5.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                    <div class="col col9">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-1.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                    <div class="col col10">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('customer/img/product/feature-product/f-p-4.jpg') }}" alt="">
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="#">
                                <h4>Long Sleeve TShirt</h4>
                            </a>
                            <h5>$150.00</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <nav class="cat_page mx-auto" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">01</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">02</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">03</a>
                            </li>
                            <li class="page-item blank">
                                <a class="page-link" href="#">...</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">09</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection
