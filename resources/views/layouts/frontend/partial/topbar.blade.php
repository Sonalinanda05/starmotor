<div id="loading-container">
    <img src="{{ asset('frontend/assets/images/loading (3).gif') }}" alt="Loading..." id="loading-image">
</div>
<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a href="{{ '/' }}" class="navbar-brand"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt /></a>
        @if (Auth::user())
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><button
                    class="btn btn-outline-success loginbutton" type="button">Log Out</button></a></a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
        <div class="swiae_mobile">
            <button class="swiae_hamburger">☰</button>
            <button class="swiae_cross">˟</button>
        </div>
            <form class="form-inline">
                <a data-bs-toggle="modal" href="#ModalForm" id="modal"><button class="btn btn-outline-success loginbutton"
                        type="button">Log In</button></a>
            </form>
            <div class="swiae_menu">
                
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" aria-expanded="false">Buy</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                By Model
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($modelNames as $modelName)
                                    <li><a class="dropdown-item" href="{{ route('car.model', ['modelName' => $modelName]) }}">{{ $modelName }}</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                @endforeach
                                <li>
                                    <form method="get" action="{{ route('car.model', ['modelName' => 'all']) }}">
                                        @csrf
                                        <button class="btn btn-outline-success my-2 my-sm-0 viewall" type="submit">VIEW ALL MODELS</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">By Price</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => 'less-than-1-lakh']) }}">Less than 1 Lakh</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => '1-to-3-lakh']) }}">1 to 3 Lakh</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => '3-to-6-lakh']) }}">3 to 6 Lakh</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => 'more-than-6-lakh']) }}">More than 6 Lakh</a></li>
                                {{-- <li><hr class="dropdown-divider" /></li> --}}
                                {{-- <li>
                                    <form method="get" action="{{ route('car.Price', ['priceRange' => 'see-more']) }}">
                                        @csrf
                                        <button class="btn btn-outline-success my-2 my-sm-0 viewall" type="submit">See More</button>
                                    </form>
                                </li> --}}
                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">By Fuel Type</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($fuel_types as $fuel_type)
                                    
                                
                                <li><a class="dropdown-item" href="{{ route('car.FuelType', ['fuel_types' => $fuel_type]) }}">{{$fuel_type}}</a></li>
                                {{-- <li>
                                    <hr class="dropdown-divider" />
                                </li> --}}
                                @endforeach
                                {{-- <li>
                                    <form method="get" action="{{ route('car.FuelType', ['fuel_types' => 'all']) }}">
                                        @csrf
                                        <button class="btn btn-outline-success my-2 my-sm-0 viewall" type="submit">VIEW ALL FUEL TYPES</button>
                                    </form>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">By Body Type</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($body_types as $body_type)
                                    
                                
                                <li><a class="dropdown-item" href="{{ route('car.BodyType', ['body_types' => $body_type]) }}">{{ $body_type }}</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                @endforeach
                                <li>
                                    {{-- <form method="get" action="{{ route('car.BodyType', ['body_types' => 'all']) }}">
                                        @csrf
                                        <button class="btn btn-outline-success my-2 my-sm-0 viewall" type="submit">VIEW ALL BODY TYPES</button>
                                    </form> --}}
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white bg-danger" href="{{ route('user.sell.cars') }}" tabindex="-1"
                                aria-disabled="true">Sell</a>
                        </li>
                        <li>
                            {{-- <form class="form-inline"> --}}
                                {{-- <a data-bs-toggle="modal" href="#ModalForm" id="modal"><button class="btn btn-outline-success loginbutton"
                                        type="button">Log In</button></a> --}}
                                        <a  data-bs-toggle="modal" class="nav-link" href="#ModalForm" id="modal" role="button" aria-expanded="false">Login</a>
                            {{-- </form> --}}
                        </li>
        
                    </ul>
             
            </div>

        @endif
    </div>
</nav>

<!-- start navbar -->
<nav class="navbar navbar-expand-lg navbar-white bg-primary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" aria-expanded="false">Buy</a>
                </li>

               

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        By Model
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($modelNames as $modelName)
                            <li><a class="dropdown-item" href="{{ route('car.model', ['modelName' => $modelName]) }}">{{ $modelName }}</a></li>
                            <li><hr class="dropdown-divider" /></li>
                        @endforeach
                        <li>
                            <form method="get" action="{{ route('car.model', ['modelName' => 'all']) }}">
                                @csrf
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">VIEW ALL MODELS</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">By Price</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => 'less-than-1-lakh']) }}">Less than 1 Lakh</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => '1-to-3-lakh']) }}">1 to 3 Lakh</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => '3-to-6-lakh']) }}">3 to 6 Lakh</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('car.Price', ['priceRange' => 'more-than-6-lakh']) }}">More than 6 Lakh</a></li>
                        {{-- <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="get" action="{{ route('car.Price', ['priceRange' => 'see-more']) }}">
                                @csrf
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">See More</button>
                            </form>
                        </li> --}}
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">By Fuel Type</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($fuel_types as $fuel_type)
                            
                        
                        <li><a class="dropdown-item" href="{{ route('car.FuelType', ['fuel_types' => $fuel_type]) }}">{{$fuel_type}}</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        @endforeach
                        {{-- <li>
                            <form method="get" action="{{ route('car.FuelType', ['fuel_types' => 'all']) }}">
                                @csrf
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">VIEW ALL FUEL TYPES</button>
                            </form>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">By Body Type</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($body_types as $body_type)
                            
                        
                        <li><a class="dropdown-item" href="{{ route('car.BodyType', ['body_types' => $body_type]) }}">{{ $body_type }}</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        @endforeach
                        {{-- <li>
                            <form method="get" action="{{ route('car.BodyType', ['body_types' => 'all']) }}">
                                @csrf
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">VIEW ALL BODY TYPES</button>
                            </form>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white bg-danger" href="{{ route('user.sell.cars') }}" tabindex="-1"
                        aria-disabled="true">Sell</a>
                </li>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            </form>
        </div>
    </div>
</nav>
<!-- end nav bar -->
