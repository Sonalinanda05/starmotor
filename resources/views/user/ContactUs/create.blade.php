@extends('layouts.frontend.app')

@section('content')
<section class="blogg">
    <div class="container mt-4">
      <div class="row">
        <!-- Left Side: Blog Posts -->
        <div class="col-md-8">
          <div class="top">
            <div>
              <a href="{{ '/' }}">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                href="contact.html">Contact</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="contact-left">
            <h3>Contact Us</h3>
            <div class="col-md-12 col-lg-12">
              <div class="contact-rtp">
                <h4><i class="fa-solid fa-phone-volume"></i>&nbsp;&nbsp;Contact
                  No</h4>
                <p>+123456789</p>
                <p></p>
              </div>
            </div>
            <div class="col-md-12 col-lg-12">
              <div class="contact-rtp">
                <h4><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;Email</h4>
                <p>starmotors@gmail.com</p>
                <p></p>
              </div>
            </div>
            <div class="col-md-12 col-lg-12">
              <div class="contact-rtp">
                <h4><i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;Head
                  Office</h4>
                <p>bbsr,laxmisagar</p>
                <p></p>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-6 col-lg-6">
          <div class="contact-right">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
              <div class="contact-heading">
                <h3>Contact us</h3>
                <p>With the query that you have. Please fill in the details.</p>
              </div>
              <div class="contact-form">
                <input type="text" placeholder="Name" name="name" required>
              </div>
              <div class="contact-form">
                <input type="email" placeholder="Email" name="email" required>
              </div>
              <div class="contact-form">
                <input type="text" placeholder="Mobile No" name="phone" maxlength="10" required>
              </div>
              <div class="contact-form">
                <textarea placeholder="Message" name="message" required></textarea>
              </div>
              <div class="custumCheckbox">
                <input type="checkbox" required>I authorize Star Motors India Ltd.or its partners to call me.
                Please read our <a href="/privacy-policy" target="_blank">
                  Privacy Policy.
                </a>
              </div>
              <a href="#"><button type="submit" class="readbutton">Submit</button></a>

            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection