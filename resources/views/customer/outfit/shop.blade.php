@php
    $title = 'Our Shop';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('outfit.shop'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Category Product Area --}}
    <section class="cat_product_area section_gap">
        <div class="container-fluid">
            <div class="row">
                 <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($categories as $category)
                                        <li @if (isset($keyword) && $keyword == $category) class="active" @endif>
                                            <a href="{{ route('outfit.search', 'prefix=category&keyword=' . $category) }}" onclick="event.preventDefault(); document.getElementById('{{ $category }}-form').submit();">
                                                {{ ucfirst($category) }}
                                            </a>
                                            <form id="{{ $category }}-form" action="{{ route('outfit.search') }}" method="GET" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="prefix" value="category">
                                                <input type="hidden" name="keyword" value="{{ $category }}">
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Outfit Filters</h3>
                            </div>
                            <div class="widgets_inner">
                                <h4>Type</h4>
                                <ul class="list">
                                    @foreach ($types as $type)
                                        <li @if (isset($keyword) && $keyword == strtolower($type->label)) class="active" @endif>
                                            <a href="{{ route('outfit.search', 'prefix=type&keyword=' . strtolower($type->label)) }}" onclick="event.preventDefault(); document.getElementById('{{ strtolower($type->label) }}-form').submit();">
                                                {{ $type->label }}
                                            </a>
                                            <form id="{{ strtolower($type->label) }}-form" action="{{ route('outfit.search') }}" method="GET" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="prefix" value="type">
                                                <input type="hidden" name="keyword" value="{{ strtolower($type->label) }}">
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widgets_inner">
                                <h4>Color</h4>
                                <ul class="list">
                                    @foreach ($colors as $color)
                                        <li @if (isset($keyword) && $keyword == $color) class="active" @endif>
                                            <a href="{{ route('outfit.search', 'prefix=color&keyword=' . $color) }}" onclick="event.preventDefault(); document.getElementById('{{ $color }}-form').submit();">
                                                {{ ucfirst($color) }}
                                            </a>
                                            <form id="{{ $color }}-form" action="{{ route('outfit.search') }}" method="GET" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="prefix" value="color">
                                                <input type="hidden" name="keyword" value="{{ $color }}">
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widgets_inner">
                                <h4>Price (XAF)</h4>

                                <div class="range_item">
                                    <div id="slider-range" class="price-filter-range w-100" name="rangeInput"></div>

                                    <form class="d-flex" action="{{ route('outfit.search') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="prefix" value="price">
                                        <input type="hidden" name="keyword" value="price">

                                        <input type="number" name="min_price" min=0 max="99999" oninput="validity.valid||(value='{{ isset($min_price) ? $min_price : 0 }}');" id="min_price" class="price-range-field">
                                        <input type="number" name="max_price" min=0 max="100000" oninput="validity.valid||(value='{{ isset($max_price) ? $max_price : 100000 }}');" id="max_price" class="price-range-field">

                                        <button type="submit" class="main-btn genric-btn info circle arrow medium" id="price-range-submit">
                                            <i class="fas fa-search-dollar"></i>
                                        </button>
                                    </form>
                                </div>

                                @if (isset($min_price) && isset($max_price))
                                    <div class="mt-4">
                                        You searched for outfits between <strong>@convert($min_price)</strong> and <strong>@convert($max_price)</strong>.
                                    </div>
                                @endif
                            </div>
                        </aside>
                    </div>
                </div>

                <div class="col-lg-9 d-flex flex-column align-items-center">
                    <div class="product_top_bar w-100">
                        <form class="left_dorp d-flex align-items-center" id="sorting-form" action="{{ route('outfit.search') }}" method="GET">
                            @csrf
                            <input type="hidden" name="prefix" value="{{ isset($prefix) ? $prefix : '' }}">
                            <input type="hidden" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}">

                            @if (isset($min_price) && isset($max_price))
                                <input type="hidden" name="min_price" value="{{ $min_price }}">
                                <input type="hidden" name="max_price" value="{{ $max_price }}">
                            @endif

                            <label for="sorting" class="mb-0 mr-3">Sort by</label>
                            <select name="sorting" class="sorting" id="sorting" onchange="event.preventDefault(); document.getElementById('sorting-form').submit();">
                                <option value="1" @if (!isset($_GET['sorting']) || $_GET['sorting'] == 1) selected @endif>Newest Arrivals</option>
                                <option value="2" @if (isset($_GET['sorting']) && $_GET['sorting'] == 2) selected @endif>Price: Low to High</option>
                                <option value="3" @if (isset($_GET['sorting']) && $_GET['sorting'] == 3) selected @endif>Price: High to Low</option>
                                <option value="4" disabled>Avg. Customer Review</option>
                            </select>
                        </form>

                        @if (isset($min_price) && isset($max_price))
                            <div class="right_page m-auto">
                                You searched for outfits between <strong>@convert($min_price)</strong> and <strong>@convert($max_price)</strong>.
                            </div>
                        @endif
                    </div>

                    <div class="latest_product_inner row w-100 mb-4">
                        @if ($outfits->isEmpty())
                            <div class="alert alert-primary w-100" role="alert">
                                <strong>Info!</strong> No outfits available!
                            </div>
                        @else
                            @foreach ($outfits as $outfit)
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="f_p_item">
                                        <div class="f_p_img">
                                            <img class="img-fluid" src="{{ show_photo(get_outfit_cover($outfit->id)->filename) }}" alt="">
                                            <div class="p_icon d-flex">
                                                <form class="form-add-to-wishlist" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                                                    <button type="submit" class="btn-add-to-wishlist">
                                                        <i class="lnr lnr-heart"></i>
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

                    <nav class="cat_page mt-5" aria-label="Page navigation example">
                        {{ $outfits->links() }}
                    </nav>
                </div>
            </div>

        </div>
    </section>

@endsection
