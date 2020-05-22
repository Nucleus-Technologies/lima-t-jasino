<footer class="footer-area section_gap">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <img src="{{ asset('brand/white.png') }}" alt="" width="150" class="mb-4">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Services</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('outfit.shop') }}">Shop</a></li>
                        <li><a href="{{ route('appointment.create') }}">Book appointment</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Outfits Collection</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('collection.men') }}">Men</a></li>
                        <li><a href="{{ route('collection.women') }}">Women</a></li>
                        <li><a href="{{ route('collection.weddings') }}">Weddings</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Users</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><a href="{{ route('appointment') }}">Cart</a></li>
                        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Delivery Zone</h6>
                    <ul class="list-delivery">
                        <li><i class="fas fa-map-marker-alt"></i> On the Cameroonian national territory</li>
                        <li><i class="fas fa-map-marker-alt"></i> At the international level</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Payment Mode</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget instafeed">
                    <h6 class="footer_title">Instagram Feed</h6>
                    <ul class="list instafeed d-flex flex-wrap">
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-01.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-02.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-03.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-04.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-05.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-06.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-07.jpg') }}" alt="">
                        </li>
                        <li>
                            <img src="{{ asset('customer/img/instagram/Image-08.jpg') }}" alt="">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget f_social_wd">
                    <h6 class="footer_title">Follow Us</h6>
                    <p>Let us be social</p>
                    <div class="f_social">
                        <a href="https://www.facebook.com/Lima-T-Jasino-1533113203618905/" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/lima_t_jasino" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/lima_t_jasino/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.pinterest.fr/tjasino/" target="_blank">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between align-items-center">
            <p class="col-lg-12 footer-text text-center">
                Copyright &copy; {{ Carbon\Carbon::now()->format('Y') }} |  All rights reserved <br>
                Designed by <a href="https://colorlib.com/" target="_blank">Colorlib</a>
                & Developed by <a href="https://nucleus-technologies.com" target="_blank">Nucléus Technologies</a>
                with <i class="fas fa-heart" aria-hidden="true"></i>
            </p>
        </div>
    </div>
</footer>
