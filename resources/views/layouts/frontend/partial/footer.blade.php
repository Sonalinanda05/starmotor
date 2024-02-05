 <!-- start uperftr -->
 
 <section class="footer-top">
    <div class="container">
        <div class="row">
            <div class="container-main">
                <div class="col-md-3 col-lg-3">
                    <div class="pic">
                        <a href="car-details.html"><img src="{{ asset('frontend/assets/images/mobile.png')}}" alt></a>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="content">
                        <h3>10,000 Car are Available Here.</h3>
                        <p>Book Now Click On The site Button </p>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="button-img">
                        <div class="footer-top-button">
                            <a href="{{ '/' }}" class="btn1_all ">Home</a>
                            <a href="{{ route('contact.create') }}" class="btn1_all ">Book Now</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="contnt-link">
                        <h3>Quick Link :-</h3>
                        <ul>
                            <li><a href="https://www.facebook.com/"><i class="fa-brands fa-facebook ms-4"></i></a></li>
                            <li><a href="https://www.instagram.com/accounts/login/"><i class="fa-brands fa-instagram ms-4"></i></a></li>
                            <li><a href="https://www.google.co.in/"><i class="fa-brands fa-google ms-4"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- end uperftr -->


<div class="foter_sec">
    <div class="container">
        <div class="row">
            <div class="foter_sec_main">
                <div class="col-lg-8 col-md-9">
                    <div class="foter_sec_main_box">
                        <div class="foter_sec_main_box_fig">
                            <img class="fima" src="{{ asset('frontend/assets/images/logo.png')}}" alt title>
                        </div>
                        <p>Welcome to Star Motors, your premier destination for buying and selling used cars! At Star Motors, we understand that finding the perfect vehicle can be a significant decision, and that's why we've created a platform that makes the process simple, transparent, and enjoyable for both buyers and sellers.

                            For those looking to sell their used cars, Star Motors provides a hassle-free experience. Our user-friendly interface allows sellers to easily list their vehicles, providing detailed information and high-quality images to showcase the unique features and condition of their cars. With our advanced search and filtering options, potential buyers can quickly find the cars that meet their criteria, ensuring a seamless connection between sellers and interested parties.</p>
                        <ul>
                            <li><a href="#"><i class="fas fa-phone-alt"></i>
                                    +91-123655896</a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i>
                                    starmotors@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div class="foter_sec_main_box cntr">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{ '/' }}">Home</a></li>
                            <li><a href="{{ route('car.aboutUs') }}">AboutUs</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="{{ route('contact.create') }}">ContactUs</a></li>
                            <li><a href="{{ route('user.view.cars') }}">Buy</a></li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-3">
                    <div class="foter_sec_main_box cntr">
                        <h3>Top Categories</h3>
                        <ul>
                            
                            <li><a href="#">By Model</a></li>
                            <li><a href="#">By Price</a></li>
                            <li><a href="#">By Body Type</a></li>
                          
                        </ul>
                    </div>
                </div> --}}
                
            </div>
        </div>
    </div>
</div>
<div class="cpyrit_sec">
    <p>&copy; StarMotors. All rights reserved.</p>
    <span>Designed&nbsp;by<a href="https://metaveostechnologies.com/">Metaveos&nbsp;Technologies</a></span>
</div>
