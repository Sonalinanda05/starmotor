<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Star Motors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style1.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- login modal -->

    <div class="modal fade" id="ModalForm" tabindex="-1" aria-hidden="true" style="padding-right: 0px">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content form ">

                <form action="{{ route('login') }}" method="post">
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
                        <p class="regis" data-bs-target="#ModalForm2" data-bs-toggle="modal" data-bs-dismiss="modal">
                            Register</p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalForm2" aria-hidden="true" tabindex="-1" style="padding-right: 0px">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content form ">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <h1>Register</h1>
                    <div class="input-box">
                        <input type="text" placeholder="Username" name="name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Mobile no" name="phone" maxlength="10" required>
                        @error('phone')
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
                    <div class="input-box">
                        <input type="password" placeholder="Confirm password" name="password_confirmation" required>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" name>remember me</label>
                    </div>
                    <button type="submit" class="btnn">Register</button>

                    <div class="register-link">
                        <p>If you are already register ? </p>&nbsp;&nbsp;&nbsp;
                        <p class="regis" data-bs-target="#ModalForm" data-bs-toggle="modal"
                            data-bs-dismiss="modal">
                            Login</p>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- top-navbar -->
    @include('layouts.frontend.partial.topbar')
    <!-- end top -->



    @yield('content')



    <!-- start fter part -->

    @include('layouts.frontend.partial.footer')
    <script src="{{ asset('frontend/assets/js/index.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script type="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        jQuery("#carmodel-slidersldr").owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: false,
            autoHeight: true,
            smartSpeed: 2000,
            dots: false,
            nav: false,
            navText: [

            ],
            responsive: {
                0: {
                    items: 1,
                },

                600: {
                    items: 1,
                },

                1024: {
                    items: 6,
                },

                1366: {
                    items: 6,
                },
            },
        });
    </script>
    <script>
        jQuery("#add-rate-slidersldr").owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: false,
            autoHeight: true,
            smartSpeed: 2000,
            dots: false,
            nav: false,
            navText: [

            ],
            responsive: {
                0: {
                    items: 1,
                },

                600: {
                    items: 1,
                },

                1024: {
                    items: 3,
                },

                1366: {
                    items: 3,
                },
            },
        });
    </script>
    <script>
        jQuery("#testimonial-slider").owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: false,
            autoHeight: true,
            smartSpeed: 2000,
            dots: false,
            nav: false,
            navText: [],
            responsive: {
                0: {
                    items: 1,
                },

                600: {
                    items: 1,
                },

                1024: {
                    items: 2,
                },

                1366: {
                    items: 2,
                },
            },
        });
    </script>
    <script>
        jQuery("#testimonial-slider-right").owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: false,
            autoHeight: true,
            smartSpeed: 2000,
            dots: false,
            nav: false,
            navText: [

            ],
            responsive: {
                0: {
                    items: 1,
                },

                600: {
                    items: 1,
                },

                1024: {
                    items: 2,
                },

                1366: {
                    items: 2,
                },
            },
        });
    </script>
    <script>
        function changeRating(element) {

            let currentRating = parseInt(element.getAttribute("data-rating"));


            currentRating = (currentRating % 5) + 1;

            element.setAttribute("data-rating", currentRating);
            displayStars(element, currentRating);
        }

        function displayStars(element, rating) {

            const starSymbol = "&#9733;";
            const stars = starSymbol.repeat(rating);
            element.innerHTML = stars.padEnd(5, "&#9734;");
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdowns = document.querySelectorAll('.nav-item.dropdown');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('mouseover', function() {
                    this.querySelector('.dropdown-menu').classList.add('show');
                });
                dropdown.addEventListener('mouseout', function() {
                    this.querySelector('.dropdown-menu').classList.remove('show');
                });
            });
        });
    </script>
    <script>
        $(".swiae_cross").hide();
        $(".swiae_menu").hide();
        $(".swiae_hamburger").click(function() {
            $(".swiae_menu").slideToggle("slow", function() {
                $(".swiae_hamburger").hide();
                $(".swiae_cross").show();
            });
        });

        $(".swiae_cross").click(function() {
            $(".swiae_menu").slideToggle("slow", function() {
                $(".swiae_cross").hide();
                $(".swiae_hamburger").show();
            });
        });
    </script>
    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    @stack('scripts')

</body>

</html>
