@extends('layouts.auth_base')
@section('content')

{{-- <div class="login_wrapper" id="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form action="{{route('login_user')}}" method="post">
            @csrf
          <h1 class="color_white">GooPaperless</h1>
          <div>
            <input type="text" class="form-control" placeholder="Email" name="txt_email" id="txt_email" value="{{ old('txt_email') }}"/>
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Password" name="txt_password" id="txt_password" />
          </div>
          <div>
            <button type="submit" class="btn btn-success success" id="submit_btn"><i class="fa fa-sign-in"></i>     Log in</button>
            <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
          </div>

          <div class="clearfix"></div>

        </form>
      </section>
    </div>

    <!-- <div id="register" class="animate form registration_form">
      <section class="login_content">
        <form>
          <h1>Create Account</h1>
          <div>
            <input type="text" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input type="email" class="form-control" placeholder="Email" required="" />
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Password" required="" />
          </div>
          <div>
            <a class="btn btn-default submit" href="index.html">Submit</a>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link">Already a member ?
              <a href="#signin" class="to_register"> Log in </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
            </div>
          </div>
        </form>
      </section>
    </div> -->
</div> --}}

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
              <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block" id="company_name">GooPaperless</span>
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Sign In</h5>
                {{-- <p class="text-center small">Enter your personal details to create account</p> --}}
              </div>

              <form action="{{route('login_user')}}" method="post" class="row g-3" >
                @csrf

                <div class="col-12 mb-3">
                  <label for="txt_email" class="form-label">Your Email</label>
                  <input type="email" name="txt_email" class="form-control" id="txt_email" value="{{ old('txt_email') }}" >
                  <span class="text-danger">@error('txt_email') {{ $message }} @enderror</span>
                </div>


                <div class="col-12 mb-4">
                  <label for="txt_password" class="form-label">Password</label>
                  <input type="password" name="txt_password" class="form-control" id="txt_password" required>
                  <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                </div>

                <div class="col-12">
                  <button class="btn w-100 submit" type="submit">Sign In</button>
                </div>
                <div class="col-12 mb-5">
                  <p class="small mb-0">Don't have an account? <a href="{{ url('register') }}">Sign Up</a></p>
                </div>
              </form>

            </div>
          </div>



        </div>
      </div>
    </div>

</section>

@endsection
