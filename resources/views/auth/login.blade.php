@extends('layouts.frontend.app')

@section('content')
<div>
    
    <section id="contact" class="contact" style="margin-top: 218px;" >
       
        <div class="container" data-aos="fade-up">
            
            <div class="section-title">
                
                <h2 class="text-center text-primary" style="font-size: 25px">SIGN IN</h2>
            </div>
            <div class="row">
                <div class="col-md-12 mt-12 mt-lg-0 d-flex align-items-stretch">
                    <form action="{{ route('login') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="employee_id">Email</label>
                                <input type="text" class="form-control" name="email" id="email" required autocomplete="email" autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Your password</label>
                                <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <a href="#"><button type="submit">Log In</button></a>
                        </div>

                       
                        <div class="text-center">
                            <a href="{{ route('register') }}">New User ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
