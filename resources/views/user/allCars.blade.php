@extends('layouts.frontend.app')

@section('content')
    <section class="blogg">
        <div class="container mt-4">
            <div class="row">
                <!-- Left Side: Blog Posts -->
                <div class="col-md-8">
                    <div class="top">
                        <div>
                            <a href="{{ '/' }}">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a>Buy Car</a>
                        </div>
                        <div>
                            @if (Auth::user())
                                <form action="{{ route('cars.sort') }}" method="get">
                                    <select class="short" name="sort_by" onchange="this.form.submit()">
                                        <option selected>SORT BY</option>
                                        <option value="Price(Low to High)">Price(Low to High)</option>
                                        <option value="Price(High to Low)">Price(High to Low)</option>
                                        <option value="Km(Low to High)">Km(Low to High)</option>
                                        <option value="Km(High to Low)">Km(High to Low)</option>
                                        <option value="Year Ascending">Year Ascending</option>
                                        <option value="Year Descending">Year Descending</option>
                                    </select>
                                </form>
                            @else
                                <form action="{{ route('car.sort') }}" method="get">
                                    <select class="short" name="sort_by" onchange="this.form.submit()">
                                        <option selected>SORT BY</option>
                                        <option value="Price(Low to High)">Price(Low to High)</option>
                                        <option value="Price(High to Low)">Price(High to Low)</option>
                                        <option value="Km(Low to High)">Km(Low to High)</option>
                                        <option value="Km(High to Low)">Km(High to Low)</option>
                                        <option value="Year Ascending">Year Ascending</option>
                                        <option value="Year Descending">Year Descending</option>
                                    </select>
                                </form>
                            @endif


                        </div>
                    </div>
                    <h4 class="mb-5">{{ $Cars->count() }} Used Cars in Bhubaneswar for sale!</h4>

                    <div class="row">
                        <!-- Blog Post 1 -->
                        @foreach ($Cars as $car)
                            <div class="col-md-6 mb-4">
                                @if (Auth::user())
                                    <a href="{{ route('users.cars.details', ['id' => $car->id]) }}">
                                        <div class="card shadow">
                                            <div class="imageborder">
                                                <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top image"
                                                    alt="...">
                                            </div>

                                            <div class="card-body">

                                                <h5 class="card-title" style="color:#a11a58">{{ $car->name }}</h5>

                                                <p class="card-text">{{ $car->car_age }} | {{ $car->fuel_type }} |
                                                    {{ $car->kilometers_driven }}km</p>
                                                <div class="rate">
                                                    <p class="card-text"><span class="fs-4">&#8377;
                                                            {{ number_format($car->sell_price, 2, '.', ',') }}</span></p>
                                                    <h4 class="rating" onclick="changeRating(this)" data-rating="0">
                                                        &#9734;&#9734;&#9734;&#9734;&#9734;
                                                    </h4>
                                                </div>
                                                <a href="contact.php" class="btn btn-primary "
                                                    style="background-color:#a11a58">Contact Dealer</a>
                                                <a href="{{ route('users.cars.details', ['id' => $car->id]) }}"
                                                    class="btn btn-primary m-2" style="background-color:#a11a58">Book
                                                    Now</a>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ route('users.car.details', ['id' => $car->id]) }}">
                                        <div class="card shadow">
                                            <div class="imageborder">
                                                <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top image"
                                                    alt="...">
                                            </div>

                                            @php
                                                $averageRating = $averageRatings[$car->id] ?? 0;
                                                $roundedRating = round($averageRating);
                                            @endphp
                                            <div class="card-body">

                                                <h5 class="card-title" style="color:#a11a58">{{ $car->name }}</h5>

                                                <p class="card-text">{{ $car->car_age }} | {{ $car->fuel_type }} |
                                                    {{ $car->kilometers_driven }}km</p>
                                                <div class="rate">
                                                    <p class="card-text"><span class="fs-4">&#8377;
                                                            {{ number_format($car->sell_price, 2, '.', ',') }}</span></p>
                                                    <h4 class="rating" data-rating="{{ $averageRating }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $roundedRating)
                                                                <i class="fas fa-star fa-xs"></i>
                                                            @else
                                                                <i class="far fa-star fa-xs"></i>
                                                            @endif
                                                        @endfor
                                                    </h4>
                                                </div>
                                                <a href="#" class="btn btn-primary "
                                                    style="background-color:#a11a58">Contact Dealer</a>
                                                <a href="{{ route('users.car.details', ['id' => $car->id]) }}"
                                                    class="btn btn-primary m-2" style="background-color:#a11a58">Book
                                                    Now</a>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    {{ $Cars->links() }}
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Refine Your Result</h5>

                        </div>
                    </div>
                    <form action="{{ route('car.filter') }}" method="GET">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="symbol">
                                    <h6 class="card-title">Select Budget</h6>
                                    <div id="budgetMenuSymbol" style="cursor: pointer;"
                                        onclick="toggleMenu('budgetMenu', 'budgetMenuSymbol')">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="budgetMenu" style="display: none;" class=" mt-4">
                                    <input type="radio" class="btn-check" name="budgetRadio" id="btnradio1" value="1L"
                                        autocomplete="off">
                                    <label class="btn btn-outline-warning mt-2 ms-2 radiob" for="btnradio1">Less than
                                        1L</label>


                                    <input type="radio" class="btn-check" name="budgetRadio" id="btnradio1"
                                        value="1L" autocomplete="off">
                                    <label class="btn btn-outline-warning mt-2 ms-2 radiob" for="btnradio1">1L-3L</label>


                                    <input type="radio" class="btn-check" name="budgetRadio" id="btnradio1"
                                        value="1L" autocomplete="off">
                                    <label class="btn btn-outline-warning mt-2 ms-2 radiob" for="btnradio1">3L-6L</label>


                                    <input type="radio" class="btn-check" name="budgetRadio" id="btnradio1"
                                        value="1L" autocomplete="off">
                                    <label class="btn btn-outline-warning mt-2 ms-2 radiob" for="btnradio1">More than
                                        6L</label>

                                </div>
                                <hr class="hr">
                                <div class="symbol">
                                    <h6 class="card-title">Body Type</h6>
                                    <div id="bodytypeMenuSymbol" style="cursor: pointer;"
                                        onclick="toggleMenu('bodytypeMenu', 'bodytypeMenuSymbol')">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="bodytypeMenu" style="display: none;" class=" mt-4">
                                    @foreach ($bodyTypesWithCounts as $bodyType => $count)
                                        <input type="radio" class="btn-check" name="bodyTypeRadio"
                                            id="btnradio{{ $bodyType }}" value="{{ $bodyType }}"
                                            autocomplete="off">
                                        <label class="btn btn-outline-warning mt-2 ms-2 radiob"
                                            for="btnradio{{ $bodyType }}">{{ $bodyType }}
                                            ({{ $count }})
                                        </label>
                                    @endforeach

                                </div>
                                <hr class="hr">
                                <div class="symbol">
                                    <h6 class="card-title">Brand</h6>
                                    <div id="cardbodyMenuSymbol" style="cursor: pointer;"
                                        onclick="toggleMenu('cardbodyMenu', 'cardbodyMenuSymbol')">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="cardbodyMenu" style="display: none;" class=" mt-4 cardbody">
                                    @foreach ($brandCounts as $brand => $count)
                                        <span>
                                            <input type="checkbox" name="brands[]" value="{{ $brand }}"
                                                onclick="toggleOptions('suboptions{{ $brand }}')">
                                            {{ $brand }} ({{ $count }})
                                        </span>
                                        <div class="suboptions{{ $brand }} ms-4 options">
                                            @foreach ($brandModels[$brand] as $model)
                                                <p>
                                                    <input type="checkbox" name="models[]"
                                                        value="{{ $model['model'] }}">
                                                    {{ $model['model'] }} ({{ $model['count'] }})
                                                </p>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                                <hr class="hr">
                                <div class="symbol">
                                    <h6 class="card-title">Owner</h6>
                                    <div id="ownerMenuSymbol" style="cursor: pointer;"
                                        onclick="toggleMenu('ownerMenu', 'ownerMenuSymbol')">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="ownerMenu" style="display: none;" class="ms-2 mt-3 owner">
                                    @foreach ($owners as $owner => $count)
                                        <span><input type="checkbox" name="owners[]" value="{{ $owner }}">
                                            {{ $owner }} Owner ({{ $count }})
                                        </span>
                                    @endforeach
                                </div>
                                <hr class="hr">
                                <div class="symbol">
                                    <h6 class="card-title">Fuel Type</h6>
                                    <div id="fuelMenuSymbol" style="cursor: pointer;"
                                        onclick="toggleMenu('fuelMenu', 'fuelMenuSymbol')">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="fuelMenu" style="display: none;" class="ms-2 mt-3 fuel">
                                    @foreach ($fuelTypesWithCounts as $fuelType => $count)
                                        <span><input type="checkbox" name="fuelTypes[]" value="{{ $fuelType }}">
                                            {{ $fuelType }} ({{ $count }})
                                        </span>
                                    @endforeach
                                </div>
                                <hr class="hr">
                                <div class="symbol">
                                    <h6 class="card-title">Transmission</h6>
                                    <div id="transMenuSymbol" style="cursor: pointer;"
                                        onclick="toggleMenu('transMenu', 'transMenuSymbol')">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="transMenu" style="display: none;" class="ms-2 mt-3 trans">
                                    @foreach ($transmissionWithCounts as $transmission => $count)
                                        <span><input type="checkbox" name="transmissions[]" value="{{ $transmission }}">
                                            {{ $transmission }} ({{ $count }})
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 ms-4"
                            style="background-color: #ab2774; border:none">
                            <i class="fa-solid fa-filter"></i><span class="pe-2">Apply Filters</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>
    @push('scripts')
        <script>
            function setBudgetValue(value) {
                document.getElementById('budgetValue').value = value;
            }
        </script>
    @endpush
@endsection
