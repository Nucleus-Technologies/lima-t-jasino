@php
    $title = 'My Wishlist';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('wishlist'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- My Wishlist Area --}}
    <section class="cart_area">
		<div class="container">
            <h2 class="text-center mb-5">
                Here are the outfits you've loved and added to your wishlist.
            </h2>

			<div class="cart_inner" id="wishlist_inner">
                @if ($wishlist->isEmpty())
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-xl-6">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h3 class="card-title">Your wishlist is empty!</h3>
                                    <p class="card-text">You can add wished outfits from our collection.</p>
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
                                    <th scope="col">
                                        <div class="d-flex align-items-center w-100 h5">
                                            <span class="text-uppercase mr-2">Outfits you likes</span>
                                            <span class="badge badge-dark badge-pill">{{ count($wishlist) }}</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $line)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{ show_photo($line->outfit->outfitphotos->first()->filename) }}" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h3>
                                                        <a href="{{ route('outfit.show', $line->outfit->slug) }}">{{ $line->outfit->name }}</a>
                                                    </h3>
                                                    <p>Category: <span class="text-primary">{{ ucfirst($line->outfit->category) }}</span></p>
                                                    <p>Type: <span class="text-primary">{{ $line->outfit->type->label }}</span></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="h5"><span class="text-primary">{!! format_availibility($line->outfit->availibility) !!}</span></p>
                                            <h4>@convert($line->outfit->price)</h4>
                                        </td>
                                        <td style="width:15%">
                                            <form class="form-add-to-cart pull-right" method="POST">
                                                @csrf
                                                <input type="hidden" name="outfit" value="{{ crypt_id($line->outfit->id) }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-outline-success btn-sm btn-add-to-cart">
                                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                                </button>
                                            </form>

                                            <form class="form-wishlist-outfit pull-right mt-2" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden" name="wishlist" value="{{ crypt_id($line->id) }}">

                                                <button type="button" class="btn btn-outline-danger btn-sm btn-remove-from-wishlist">
                                                    <i class="lnr lnr-trash"></i> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
			</div>
		</div>
	</section>

@endsection
