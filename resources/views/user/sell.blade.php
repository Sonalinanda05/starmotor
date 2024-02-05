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
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('frontend/assets/images/moto-3.png') }}" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend/assets/images/moto-1.png') }}" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend/assets/images/moto-4.png') }}" class="d-block w-100" alt="..." />
            </div>
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
    <div class="sell-heading">
        <h4>Here are the affordable prices for your used vehicle</h4>
    </div>
    <!-- start contact -->
    <div class="mainContactSection">
        <div class="container">
            <div class="formDisContentMain">
                <div class="formSectionSteps formStepOne">
                    <form action="{{ route('user.sell.carStore') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for>Name*</label>
                                <input type="text" class="form-control name" data-error="Please enter a valid name"
                                    data-empty="Please enter a name" maxlength="20" name="name" />
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for>Email Address</label>
                                <input type="text" id="homeEmail" data-error="Please enter a valid email address"
                                    name="email" class="form-control email2" />
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for>Mobile Number*</label>
                                <input type="tel" maxlength="10" class="form-control mobile"
                                    data-error="Please enter a valid mobile number"
                                    data-empty="Please enter a mobile number" name="phone" />
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for>Registration Number*</label>
                                <input type="text" id="homeRegistration" maxlength="13"
                                    data-error="Please enter a valid registration number."
                                    data-empty="Please enter a registration number." name="registration"
                                    class="form-control homeRegistration" />
                                <div class="regWithOutSpace">Please enter without any space</div>
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for>Car Model Name</label>
                                <input type="text" id="homeRegistration" name="model"
                                    class="form-control homeRegistration" />

                            </div>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="row">
                                <div class="form-group col-lg-9 col-md-12">
                                    <div class="custumCheckbox1">
                                        <input type="checkbox" id="policy" name="policy" class="policy"
                                            data-empty="Please authorize Star Motors India Ltd. or its partners to call you" required>
                                        <label for="checkbox1 policy">
                                            I authorize Star Motors India Ltd.or its partners to
                                            call me. Please read our <a href="/privacy-policy" target="_blank">
                                                Privacy Policy.
                                            </a>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3 col-md-12">
                                    <input type="Submit" value="submit" class="blueButton">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact end -->
    <section class="question">
        <div class="container">
            <div class="row">
                <h4>Frequently asked questions (FAQs)</h4>
                <div class="col-md-6 col-lg-6">
                    <div class="question-content">
                        <h3>How often should I change my car's oil?</h3>
                        <p>It's generally recommended to change your car's oil every 3,000
                            to 5,000 miles, but check your vehicle's manual for specific
                            guidelines.</p>
                        <h3>When should I replace my car's tires?</h3>
                        <p>Tires should be replaced when the tread depth falls below 2/32
                            of an inch. You can use a tread depth gauge to measure this.</p>
                        <h3>What does the "check engine" light mean? </h3>
                        <p>The "check engine" light indicates an issue with your vehicle's
                            engine or emissions system. It's advisable to have it diagnosed
                            by a mechanic.</p>
                        <h3>How often should I rotate my tires?</h3>
                        <p>Tire rotation is typically recommended every 6,000 to 8,000
                            miles to ensure even tire wear.</p>
                        <h3>How often should I replace my car's brake pads?</h3>
                        <p>Brake pads usually need replacement every 25,000 to 70,000
                            miles, depending on driving habits and the type of pads used.</p>
                        <h3>What is the recommended maintenance schedule for my car?</h3>
                        <p>Refer to your vehicle's manual for a comprehensive maintenance
                            schedule. It typically includes tasks such as oil changes, tire
                            rotations, and fluid checks.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="question-content">
                        <h3>What's the recommended tire pressure for my car?</h3>
                        <p>The recommended tire pressure can be found in your vehicle's
                            manual or on a sticker usually located in the driver's side door
                            jamb.</p>
                        <h3>How often should I replace my car's air filter?</h3>
                        <p>Air filters should generally be replaced every 12,000 to 15,000
                            miles, but it depends on driving conditions. Check and replace
                            as needed.</p>
                        <h3>How can I improve my car's fuel efficiency?</h3>
                        <p>Maintain regular maintenance, keep tires properly inflated,
                            drive smoothly, and avoid unnecessary idling to improve fuel
                            efficiency.</p>
                        <h3>When should I change my car's spark plugs?</h3>
                        <p>Spark plugs are typically replaced every 30,000 to 100,000
                            miles, depending on the type of spark plugs and your vehicle's
                            specifications.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
