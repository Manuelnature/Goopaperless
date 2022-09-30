@extends('layouts.auth_base')
@section('content')

<div class="login_wrapper" id="login_wrapper">
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
            {{-- <a class="reset_pass" href="#">Lost your password?</a> --}}
          </div>

          <div class="clearfix"></div>

        </form>
      </section>
    </div>

    {{-- <div id="register" class="animate form registration_form">
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
    </div> --}}
  </div>

@endsection
