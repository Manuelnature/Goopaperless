@extends('layouts.auth_base')
@section('content')

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
              <img src="assets/img/logo.png" alt="">
              <span class="d-none d-lg-block">New user</span>
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
              </div>

              <form action="{{route('register_user')}}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-12">
                  <label for="txt_firstname" class="form-label">First Name</label>
                  <input type="text" name="txt_firstname" class="form-control" id="txt_firstname" value="{{ old('txt_firstname') }}" required>
                  <div class="invalid-feedback">Please, enter your name!</div>
                </div>
                <div class="col-12">
                  <label for="txt_lastname" class="form-label">Last Name</label>
                  <input type="text" name="txt_lastname" class="form-control" id="txt_lastname" value="{{ old('txt_lastname') }}" required>
                  <div class="invalid-feedback">Please, enter your name!</div>
                </div>

                <div class="col-12">
                  <label for="txt_email" class="form-label">Your Email</label>
                  <input type="email" name="txt_email" class="form-control" id="txt_email" value="{{ old('txt_email') }}" required>
                  <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                </div>

                {{-- <div class="col-12">
                  <label for="yourUsername" class="form-label">Username</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" name="username" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Please choose a username.</div>
                  </div>
                </div> --}}

                <div class="col-12">
                  <label for="txt_password" class="form-label">Password</label>
                  <input type="password" name="txt_password" class="form-control" id="txt_password" required>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>

                <div class="col-12">
                  <label for="txt_confirm_password" class="form-label">Confirm Password</label>
                  <input type="password" name="txt_confirm_password" class="form-control" id="txt_confirm_password" required>
                  <div class="invalid-feedback">Please confirm your password!</div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Create Account</button>
                </div>
                <div class="col-12">
                  <p class="small mb-0">Already have an account? <a href="">Log in</a></p>
                </div>
              </form>

            </div>
          </div>

          

        </div>
      </div>
    </div>

  </section>

@endsection