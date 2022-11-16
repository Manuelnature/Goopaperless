@extends('layouts.auth_base')
@section('content')

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
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
              </div>

              {{-- <form action="{{route('user_register')}}" method="post" class="row g-3 needs-validation" novalidate> --}}
              <form action="{{route('user_register')}}" method="post" class="row g-3" >
                @csrf
                <div class="col-6 mb-3">
                  <label for="txt_firstname" class="form-label">First Name</label>
                  <input type="text" name="txt_firstname" class="form-control" id="txt_firstname" value="{{ old('txt_firstname') }}" >
                  <span class="text-danger">@error('txt_firstname') {{ $message }} @enderror</span>
                </div>
                <div class="col-6 mb-3">
                  <label for="txt_lastname" class="form-label">Last Name</label>
                  <input type="text" name="txt_lastname" class="form-control" id="txt_lastname" value="{{ old('txt_lastname') }}" >
                  <span class="text-danger">@error('txt_lastname') {{ $message }} @enderror</span>
                </div>

                <div class="col-6 mb-3">
                  <label for="txt_email" class="form-label">Your Email</label>
                  <input type="email" name="txt_email" class="form-control" id="txt_email" value="{{ old('txt_email') }}" >
                  <span class="text-danger">@error('txt_email') {{ $message }} @enderror</span>
                </div>

                <div class="col-6 mb-3">
                    <label for="txt_city" class="form-label">City</label>
                    <input type="text" name="txt_city" class="form-control" id="txt_city" value="{{ old('txt_city') }}" >
                    <span class="text-danger">@error('txt_city') {{ $message }} @enderror</span>
                </div>

                <div class="col-6 mb-3">
                    <label for="txt_phone_number" class="form-label">Phone Number</label>
                    <input type="number" name="txt_phone_number" class="form-control" id="txt_phone_number" value="{{ old('txt_phone_number') }}" >
                    <span class="text-danger">@error('txt_phone_number') {{ $message }} @enderror</span>
                </div>

                <div class="col-6 mb-3">
                    <label for="txt_profession" class="form-label">Profession</label>
                    <input type="text" name="txt_profession" class="form-control" id="txt_profession" value="{{ old('txt_profession') }}">
                    <span class="text-danger">@error('txt_profession') {{ $message }} @enderror</span>
                </div>

                <div class="col-12 mb-3">
                    <label for="txt_address" class="form-label">Address</label>
                    <textarea name="txt_address" class="form-control" id="txt_address"> {{ old('txt_address') }}</textarea>
                    <span class="text-danger">@error('txt_address') {{ $message }} @enderror</span>
                </div>

                {{-- <div class="col-12">
                  <label for="yourUsername" class="form-label">Username</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" name="username" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Please choose a username.</div>
                  </div>
                </div> --}}

                <div class="col-6 mb-4">
                  <label for="txt_password" class="form-label">Password</label>
                  <input type="password" name="txt_password" class="form-control" id="txt_password" required>
                  <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
                </div>

                <div class="col-6 mb-4">
                  <label for="txt_confirm_password" class="form-label">Confirm Password</label>
                  <input type="password" name="txt_confirm_password" class="form-control" id="txt_confirm_password" required>
                  <span class="text-danger">@error('txt_confirm_password') {{ $message }} @enderror</span>
                </div>

                {{-- <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
                </div> --}}
                <div class="col-12">
                  <button class="btn w-100 submit" type="submit">Create Account</button>
                </div>
                <div class="col-12 mb-3">
                  <p class="small mb-0">Already have an account? <a href="{{ url('/') }}">Log in</a></p>
                </div>
              </form>

            </div>
          </div>



        </div>
      </div>
    </div>

</section>

@endsection
