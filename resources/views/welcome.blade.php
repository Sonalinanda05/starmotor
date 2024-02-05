  @extends('layouts.frontend.app')

  @section('content')
      <!-- slider start -->
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                  aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                  aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                  aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                  aria-label="Slide 4"></button>
          </div>
          <div class="carousel-inner">
              @foreach ($banners as $index => $banner)
                  <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                      <img src="{{ asset('storage/' . $banner->banner) }}" class="d-block w-100" alt="..." />
                  </div>
              @endforeach
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
      <!-- end slider -->

      <!-- start uper sec -->
      <section class="uper-sec">
          <div class="container">
              <div class="row">
                  <div class="uper-sec_main">
                      <div class="col-lg-12 col-md-12">
                          <div class="uper-sec_main_box">
                              <div class="uper-sec_main_box_cnt">
                                  <form action="{{ route('car.search') }}" method="GET">
                                      <div class="row">
                                          <div class="col-sm-4 sbtn">
                                              <select class="form-select" aria-label="Default select example"
                                                  name="model">
                                                  <option selected>Model</option>
                                                  @foreach ($modelNames as $modelName)
                                                      <option value="{{ $modelName }}">{{ $modelName }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-sm-4 sbtn">
                                              <select class="form-select" aria-label="Default select example"
                                                  name="budget">
                                                  <option selected>Budget</option>
                                                  <option value="Less than 1 Lakh">Less than 1 Lakh</option>
                                                  <option value="1 to 3 Lakh">1 to 3 Lakh</option>
                                                  <option value="3 to 6 Lakh">3 to 6 Lakh</option>
                                                  <option value="More than 6 Lakh">More than 6 Lakh</option>
                                              </select>
                                          </div>



                                          <div class="col-sm-3 sbtn">
                                              <button type="submit" class="btn btn-light fw-bold fs-5 button"
                                                  style="color:#a11a58;margin-top:-4px ">Search</button>
                                          </div>
                                      </div>
                                  </form>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- end uper sec -->

      <!-- start addrate sec -->
      <section class="add-rate">
          <div class="container">
              <div class="col-div-12 mt-4">
                  <div class="box-12">
                      <div class="content-box">
                          <p class="fw-bold fs-4">Recently Added:</p><br>
                          @if (Auth::user())
                              <a href={{ Route('users.view.cars') }}><button
                                      class="btn btn-outline-success my-2 my-sm-0 loginbutton" type="button">View
                                      All</button></a>
                          @else
                              <a href={{ Route('user.view.cars') }}><button
                                      class="btn btn-outline-success my-2 my-sm-0 loginbutton" type="button">View
                                      All</button></a>
                          @endif
                      </div>
                  </div>
                  <div class="add-rate-slider">
                      <div id="add-rate-slidersldr" class="owl-carousel">
                          @foreach ($recentCars as $recentcar)
                              <div class="card shadow">

                                  @if (Auth::user())
                                      <div class="imageborder">
                                          <a href="{{ route('users.cars.details', ['id' => $recentcar->id]) }}"><img
                                                  src="{{ asset('storage/' . $recentcar->image) }}"
                                                  class="card-img-top image" alt="..."></a>
                                      </div>
                                  @else
                                      <div class="imageborder">
                                          <a href="{{ route('users.car.details', ['id' => $recentcar->id]) }}"><img
                                                  src="{{ asset('storage/' . $recentcar->image) }}"
                                                  class="card-img-top image" alt="..."></a>
                                      </div>
                                  @endif



                                  <div class="card-body">

                                      <h5 class="card-title" style="color:#a11a58;">{{ $recentcar->name }}</h5>

                                      <p class="card-text">{{ $recentcar->car_age }} | {{ $recentcar->fuel_type }} |
                                          {{ $recentcar->kilometers_driven }}km</p>
                                      <p class="card-text"><span
                                              class="fs-4">&#8377;{{ number_format($recentcar->sell_price, 2, '.', ',') }}
                                          </span></p>
                                      <a href="contact.php" class="btn btn-primary "
                                          style="background-color:#a11a58">Contact
                                          Dealer</a>
                                      <a href="contact.php" class="btn btn-primary m-2"
                                          style="background-color:#a11a58">Book
                                          Now</a>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>

      </section>
      <!-- end addrate section -->

      <!--end reivew slider -->

      <!-- start contact -->
      <div class="mainContactSection">
          <div class="container">
              <div class="formBannerMain">
                  <div class="bannerTxt">
                      <h3 class="forDesk">Your Search for a Fair and Transparent price
                          for your used car ends here!</h3>
                      <h3 class="forMob">Sell your car Hassle-Free</h3>
                      <p>Get started with our AI-based scientific pricing engine and
                          book a home evaluation today!</p>

                  </div>
                  <div class="bannerImg"><img src="{{ asset('frontend/assets/images/frmpic-1.png') }}" alt></div>
              </div>
              
          </div>
      </div>
      <!-- contact end -->
      <section class="about-sec">
          <div class="container">
              <div class="row">
                  <div class="about-sec-main">
                      <div class="col-md-6 col-lg-6">
                          <div class="about-sec-left">
                              <img src="{{ asset('frontend/assets/images/car-8.jpg') }}" alt>
                          </div>
                      </div>
                      <div class="col-md-6 col-lg-6 homeban">
                          <div class="about-sec-right">
                              <h4>About</h4>
                              <p class="fw-normal">Welcome to Star Motors, your premier destination for buying and selling
                                  used cars! At Star Motors, we understand that finding the perfect vehicle can be a
                                  significant decision, and that's why we've created a platform that makes the process
                                  simple, transparent, and enjoyable for both buyers and sellers.

                                  For those looking to sell their used cars, Star Motors provides a hassle-free experience.
                                  Our user-friendly interface allows sellers to easily list their vehicles, providing
                                  detailed information and high-quality images to showcase the unique features and condition
                                  of their cars. With our advanced search and filtering options, potential buyers can
                                  quickly find the cars that meet their criteria, ensuring a seamless connection between
                                  sellers and interested parties.</p>
                              <div class="about-button">
                                  <a href="{{ route('car.aboutUs') }}" class="btn_all ">Read More ....</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- start testimonial -->
      <section class="testimonial">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-lg-6">
                      <div class="testimonial-left">
                          <h4 class="mt-5" style="color: #a11a58">Reviews</h4>
                      </div>
                      <div id="testimonial-slider" class="owl-carousel">
                          @foreach ($reviews as $review)
                              <div class="card1">
                                  <h4 class="rating" data-rating="{{ $review->rating }}">
                                      @for ($i = 1; $i <= 5; $i++)
                                          @if ($i <= $review->rating)
                                              <i class="fas fa-star fa-xs"></i>
                                          @else
                                              <i class="far fa-star fa-xs"></i>
                                          @endif
                                      @endfor
                                  </h4>
                                  <p style="word-break: break-word">&ldquo;{{ $review->comment }}&rdquo;</p>
                                  <h5><span>{{ $review->users->name }}</span></h5>
                              </div>
                          @endforeach

                      </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                      <div class="testimonial-left">
                          <h4 class="mt-5" style="color: #a11a58">Top Rated Cars</h4>
                          <div id="testimonial-slider-right" class="owl-carousel">
                              @foreach ($topRatedCars as $car)
                                  <div class="card shadow">
                                      <div class="imageborder">
                                          <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top image"
                                              alt="...">
                                      </div>

                                      <div class="card-body">
                                          <h5 class="card-title" style="color:#a11a58">{{ $car->name }}</h5>
                                          <p class="card-text">{{ $car->car_age }} | {{ $car->fuel_type }} |
                                              {{ $car->kilometers_driven }}km</p>
                                          <p class="card-text"><span>&#8377;
                                                  {{ number_format($car->sell_price, 2) }}</span>
                                          </p>

                                      </div>
                                  </div>
                              @endforeach

                          </div>
                      </div>
                  </div>
      </section>
      <!-- end testimonial -->
  @endsection
