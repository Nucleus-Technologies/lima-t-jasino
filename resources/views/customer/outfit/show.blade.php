@php
    $title = 'Product Details';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('outfit.shop'). ">Shop</a>
                <a href=" .route('outfit.show', $outfit). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')
	{{-- Single Product Area  --}}
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
                                @foreach (get_outfit_photos($outfit->id) as $idx=>$img)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $idx }}" @if ($loop->first) class="active" @endif>
                                        <img src="{{ show_photo($img->filename) }}" alt="">
                                    </li>
                                @endforeach
                            </ol>

							<div class="carousel-inner">
                                @foreach (get_outfit_photos($outfit->id) as $idx=>$img)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img class="d-block w-100" src="{{ show_photo($img->filename) }}" alt="Slide {{ $idx }}">
                                    </div>
                                @endforeach
							</div>
						</div>
					</div>
                </div>

				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{ $outfit->name }}</h3>
						<h2>@convert($outfit->price)</h2>
						<ul class="list">
							<li>
								<span>Category:</span> <strong>{{ ucfirst($outfit->category) }}</strong>
							</li>
							<li>
								<span>Type:</span> <strong>{{ id_to_label($outfit->type) }}</strong>
							</li>
							<li>
								<span>Availibility:</span> <strong>{!! format_availibility($outfit->availibility) !!}</strong>
							</li>
						</ul>
                        <p>{!! back_to_line($outfit->context) !!}</p>

                        <form class="form-add-to-cart" method="POST">
                            @csrf

                            <div class="product_count">
                                <label for="qty">Quantity:</label>
                                <input type="text" name="quantity" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                <button class="increase items-count" type="button">
                                    <i class="lnr lnr-chevron-up"></i>
                                </button>
                                <button class="reduced items-count" type="button">
                                    <i class="lnr lnr-chevron-down"></i>
                                </button>
                            </div><br>

                            <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                            <button type="submit" class="main_btn btn-add-to-cart text-uppercase">
                                <i class="lnr lnr-cart mr-1"></i> Add to Cart
                            </button>
                        </form>

                        <form class="form-add-to-wishlist mt-2" method="POST">
                            @csrf
                            <input type="hidden" name="outfit" value="{{ crypt_id($outfit->id) }}">
                            <button type="submit" class="main_btn btn-add-to-wishlist text-uppercase">
                                <i class="lnr lnr-heart mr-1"></i> Add to Wishlist
                            </button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Product Description Are  --}}
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
				</li>
            </ul>

			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p>{!! back_to_line($outfit->description) !!}</p>
                </div>

				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						{!! cformat_specification($outfit->specification) !!}
					</div>
                </div>

				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="comment_list">
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('customer/img/user.svg') }}" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2017 at 05:56 pm</h5>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('customer/img/user.svg') }}" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2017 at 05:56 pm</h5>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                </div>
                                <div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('customer/img/user.svg') }}" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2017 at 05:56 pm</h5>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post a comment</h4>
								<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="btn submit_btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
                </div>

				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4>4.0</h4>
										<h6>(03 Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on 3 Reviews</h3>
										<ul class="list">
											<li>
												<a href="#">5 Star
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
                                                    <i class="fa fa-star active"></i> (1)
                                                </a>
											</li>
											<li>
												<a href="#">4 Star
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
                                                    <i class="fa fa-star"></i> (6)
                                                </a>
											</li>
											<li>
												<a href="#">3 Star
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> (3)
                                                </a>
											</li>
											<li>
												<a href="#">2 Star
													<i class="fa fa-star active"></i>
													<i class="fa fa-star active"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> (0)
                                                </a>
											</li>
											<li>
												<a href="#">1 Star
													<i class="fa fa-star active"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> (1)
                                                </a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('customer/img/user.svg') }}" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('customer/img/user.svg') }}" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('customer/img/user.svg') }}" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star active"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
							</div>
                        </div>

						<div class="col-lg-6">
							<div class="review_box">
								<h4>Add a Review</h4>

                                <p>Your Rating:</p>
                                <div class="list">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p>Outstanding</p>

								<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Review"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="btn submit_btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
