    <footer class="ps-footer">
        <div class="ps-container">
            <div class="ps-footer__widgets">
                <aside class="widget widget_footer widget_contact-us">
                    <h4 class="widget-title">Contact us</h4>
                    <div class="widget_content">
                        <p>Call us 24/7</p>
                        <h3>+9595094762 </h3>
                        <p>No.280/5 , Kyaung Street , Lane (2) , Thuwana , Yangon.<br><br><a href="mailto:ysablow@gmail.com">ysablow@gmail.com</a></p>
                        <ul class="ps-list--social">
                            <li><a class="facebook" href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a class="google-plus" href="mailto:ysablow@gmail.com"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Quick links</h4>
                    <ul class="ps-list--link">
                        <li><a href="{{ route('pages.aboutUs') }}">About Us</a></li>
                        <li><a href="{{ route('pages.contactUs') }}">Contact Us</a></li>
                        <li><a href="{{ route('profile.index') }}">Account</a></li>
                    </ul>
                </aside>
                <aside class="widget widget_footer">
                    <h4 class="widget-title">Bussiness</h4>
                    <ul class="ps-list--link">
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                        <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    </ul>
                </aside>
            </div>
            <div class="ps-footer__copyright" style="margin-bottom:40px;">
                <p>© 2020 Ysa-Fashion. All Rights Reserved</p>
                <p>Payment : Cash On Delivery.</p>
                <p><a href="https://fb.com/jionsix.hacknh/">Powered By Naing Min</a></p>
            </div>
        </div>
    </footer>
    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
        <div class="ps-search__content">
            <form class="ps-form--primary-search" action="do_action" method="post">
                <input class="form-control" type="text" placeholder="Search for...">
                <button><i class="aroma-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="false">
                            <div class="ps-product__images" data-arrow="true">
                                <div class="item"><img src="#" alt=""></div>
                                <div class="item"><img src="#" alt=""></div>
                                <div class="item"><img src="#" alt=""></div>
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1>Marshall Kilburn Portable Wireless Speaker</h1>
                            <div class="ps-product__meta">
                                <p>Brand:<a href="shop-default.html">Sony</a></p>
                            </div>
                            <h4 class="ps-product__price">$36.78 – $56.99</h4>
                            <div class="ps-product__desc">
                                <p>Sold By:<a href="shop-default.html"><strong> Go Pro</strong></a></p>
                                <ul class="ps-list--dot">
                                    <li> Unrestrained and portable active stereo speaker</li>
                                    <li> Free from the confines of wires and chords</li>
                                    <li> 20 hours of portable capabilities</li>
                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                </ul>
                            </div>
                            <div class="ps-product__shopping"><a class="ps-btn ps-btn--black" href="#">Add to cart</a><a class="ps-btn" href="#">Buy Now</a>
                                <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/jquery.min.js')}}"></script>
    <script src="{{ asset('plugins/nouislider/nouislider.min.js')}}"></script>
    <script src="{{ asset('plugins/popper.min.js')}}"></script>
    <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('plugins/masonry.pkgd.min.js')}}"></script>
    <script src="{{ asset('plugins/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery.matchHeight-min.js')}}"></script>
    <script src="{{ asset('plugins/slick/slick/slick.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script src="{{ asset('plugins/slick-animation.min.js')}}"></script>
    <script src="{{ asset('plugins/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{ asset('plugins/sticky-sidebar/dist/sticky-sidebar.min.js')}}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('plugins/gmap3.min.js')}}"></script>
    <!-- custom scripts-->
    <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>