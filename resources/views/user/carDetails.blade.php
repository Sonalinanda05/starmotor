@extends('layouts.frontend.app')

@section('content')
    <section class="car-details">
        <div class="container">
            <div class="row">
                <div class="main_car-details">
                    <div class="col-7">
                        <div class="main">
                            <div class="slider slider-for">
                                <div class="sliderimg">
                                    <img src="{{ asset('storage/' . $car->image) }}"
                                        style="height: 500px; border-radius: 5px">
                                </div>
                                @foreach (json_decode($car->gallery_image, true) ?? [] as $galleryImage)
                                    <div class="sliderimg"><img src="{{ asset('storage/' . $galleryImage) }}"
                                            style="height: 500px; border-radius: 5px"></div>
                                @endforeach

                            </div>
                            <div class="slider slider-nav">
                                <div class="smsliderimg">

                                    <img src="{{ asset('storage/' . $car->image) }}" style="height: 150px; width: 150px">
                                </div>
                                @foreach (json_decode($car->gallery_image, true) ?? [] as $galleryImage)
                                    <div class="smsliderimg">

                                        <img src="{{ asset('storage/' . $galleryImage) }}"
                                            style="height: 150px; width: 150px">
                                    </div>
                                @endforeach



                            </div>

                        </div>
                    </div>
                    <div class="col-5 ">
                        <div class="container ms-5 mt-3">
                            <div class="row">
                                <div class="col-8">
                                    <h2 class="car-details-text">{{ $car->name }}</h2>
                                </div>
                                <div class="col-4 mt-4">
                                    <a href="javascript:void(0);" onclick="shareOnWhatsApp('{{ route('car.details', ['id' => $car->id]) }}')">
                                        <i class="fa-solid fa-share-nodes fa-xl float-end" style="color: #981b64;"></i>
                                    </a>
                                </div>
                                
                                
                            </div>
                           
                            <div class="car-details-subs">
                                <img src="{{ asset('frontend/assets/images/placeholder.jpeg') }}"
                                    style="width: 20px; height: 20px;">
                                <h5 class="ms-2">Star Motors&nbsp;&nbsp;|&nbsp;&nbsp;{{ $car->location }}</h5>
                            </div>
                            <div class="rate">
                                <p class="card-text1"><span>&#8377;{{ number_format($car->sell_price, 2, '.', ',') }}</span>
                                </p>
                                <h4 class="rating" data-rating="{{ $averageRating }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                          @if ($i <= $averageRating)
                                              <i class="fas fa-star"></i>
                                          @else
                                              <i class="far fa-star"></i>
                                          @endif
                                      @endfor
                                </h4>
                            </div>
                            <div class="mt-5 icon-container">
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <i class="fa-solid fa-calendar-days fa-2xl" style="color: rgb(57, 56, 56);"></i>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4 ms-1">
                                        <i class="fa-solid fa-gas-pump fa-2xl" style="color: rgb(57, 56, 56);"></i>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4 ms-1">
                                        <i class="fa-solid fa-gauge fa-2xl" style="color: rgb(57, 56, 56);"></i>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4 " style="margin-top: -10px;">
                                        <img src="{{ asset('frontend/assets/images/manual.jpeg') }}" style="  width: 45px;">
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4 ms-1">
                                        <i class="fa-solid fa-user fa-2xl" style="color: rgb(57, 56, 56);"></i>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <h6 style="font-size: small;">{{ $car->car_age }}</h6>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <h6 style="font-size: small;">{{ $car->fuel_type }}</h6>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <h6 style="font-size: small;">{{ $car->kilometers_driven }}Km</h6>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4" style="margin-top: -10px;">
                                        <h6 style="font-size: small; margin-top: 8px; margin-left: 6px;">
                                            {{ $car->transmission }}</h6>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <h6 style="font-size: small;">{{ $car->owners_count }}&nbsp;Owner</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="cardsec">
                                <div class="smcard">
                                    <i class="fa-solid fa-award fa-2xl" style="color: #a11a58;"></i>
                                    <h6 style="font-weight: bold;">{{ $car->warranty }} Warranty</h6>
                                </div>
                                <div class="smcard">
                                    <i class="fa-solid fa-car fa-2xl" style="color: #a11a58;"></i>
                                    <h6 style="font-weight: bold;">{{ $car->free_service_count }} Free Services</h6>
                                </div>
                            </div>
                            <div class="cardsec">
                                <div class="smcard" style="height: 80px;">
                                    <img src="{{ asset('frontend/assets/images/protection .png') }}" width="30px">
                                    <h6 style="font-weight: bold; margin-left: -10px;">Refurbished
                                        with Maruti Suzuki Genuine Parts</h6>
                                </div>
                                <div class="smcard">
                                    <i class="fa-solid fa-check-double fa-2xl" style="color: #a11a58;"></i>
                                    <h6 style="font-weight: bold; margin-left: -10px;">2 Step
                                        Verification</h6>
                                </div>
                            </div>

                            @if (Auth::user())
                                <form class="mt-5" action="{{ route('bookCar.store', ['id' => $car->id]) }}"
                                    method="POST">
                                    @csrf

                                    <input type="text" name="name" placeholder="Name" required class="inputcar"
                                        value="{{ Auth::user()->name }}">
                                    <input type="text" name="phone" placeholder="Mobile Number" required
                                        class="inputcar mt-3" maxlength="10" value="{{ Auth::user()->phone }}">
                                    <input type="email" name="email" placeholder="Email" required class="inputcar mt-3"
                                        value="{{ Auth::user()->email }}">
                                    <input type="checkbox" class="mt-3" required><span class="ms-2">I
                                        authorize Star Motors or its partners to call me.Please read
                                        our <a href="Privacy-policy" target="_blank">Privacy Policy</a></span>
                                    <div class="mt-3" style="display: flex; gap: 5px;">
                                        <button type="submit" class="testdrive" data-toggle="modal"
                                            data-target="#ModalForm">BOOK A TEST DRIVE</button>
                                        <button type="submit" class="contactDealer">CONTACT DEALER</button>
                                    </div>
                                </form>




                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ModalForm" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content form ">
                        <!-- <div class="form"> -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <h1>Log In</h1>

                            <div class="input-box">
                                <input type="email" placeholder="Email" name="email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-box">
                                <input type="password" placeholder="Password" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="remember-forgot">
                                <label><input type="checkbox" name>remember me</label>
                                <a href="#">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btnn">Log In</button>
                            <div class="register-link">
                                <p>don't have an account ? </p>&nbsp;&nbsp;&nbsp;
                                <p class="regis" data-bs-target="#ModalForm2" data-bs-toggle="modal"
                                    data-bs-dismiss="modal">
                                    Register</p>
                            </div>
                        </form>
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            <div class="row">
                <h4 class="mt-4">Comments</h4>
                <div class="d-flex">
                    <form action="{{ route('review.submit',['id'=>$car->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="rating" id="rating" value="1">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="far fa-star star" data-rating="{{ $i }}"></i>
                        @endfor
                        <br>


                        <textarea name="comment" cols="70" rows="10" placeholder="Write Your Comment"></textarea><br>
                        <button class="btn comment-btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        @else
            <form class="form-inline mt-5">
                <h5>Click here to login first
                    <a data-bs-toggle="modal" href="#ModalForm"><button class="btn loginbutton" type="button">Log
                            In</button></a>
                </h5>
            </form>
            @endif
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize Slick Slider
                $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                    nextArrow: '<button type="button" class="slick-next">Next</button>',
                    fade: true,
                    // fade: true,
                    asNavFor: '.slider-nav'
                });

                $('.slider-nav').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '.slider-for',
                    // dots: true,
                    centerMode: true,
                    focusOnSelect: true
                });


            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const stars = document.querySelectorAll('.star');

                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const rating = star.getAttribute('data-rating');
                        document.getElementById('rating').value = rating;

                        stars.forEach(s => s.classList.remove('fas', 'far'));
                        for (let i = 1; i <= rating; i++) {
                            stars[i - 1].classList.add('fas');
                        }
                        for (let i = rating; i < stars.length; i++) {
                            stars[i].classList.add('far');
                        }
                    });
                });
            });
        </script>

<script>
    function shareOnWhatsApp(carDetailsUrl) {
        if (navigator.share) {
            navigator.share({
                title: 'Share Car Details',
                text: 'Check out this car details:',
                url: carDetailsUrl,
            })
                .then(() => console.log('Successful sharing'))
                .catch((error) => console.log('Error sharing', error));
        } else {
            alert("WhatsApp sharing is not supported on this device/browser.");
        }
    }
</script>
    @endpush
@endsection
