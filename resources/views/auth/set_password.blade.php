@extends('layouts.auth_base')
@section('content')

    <div class="login_wrapper">
        <div class="animate form login_form">
        <section class="login_content">
            <form action="{{route('set_user_password')}}" method="post">
                @csrf
                <h1 class="color_white">{{$set_password_email_details[0]->firstname}} {{$set_password_email_details[0]->lastname}}</h1>

                <input type="hidden" name="txt_set_password_id" value="{{ $set_password_email_details[0]->id }}">
                <input type="hidden" name="txt_set_password_email" value="{{ $set_password_email_details[0]->email }}">


                <div>
                    <input type="password" class="form-control" placeholder="Password" name="txt_set_password" id="txt_set_password" value="{{ old('txt_set_password') }}"/>
                </div>

                <div>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="txt_confirm_set_password" id="txt_confirm_set_password" />
                </div>
                <div>
                    <button type="submit" class="btn btn-default success color_white" id="submit_btn"> <i class="fa fa-sign-in"></i>    Set Password</button>
                    {{-- <a class="reset_pass" href="#">Lost your password?</a> --}}
                </div>

                <div class="clearfix"></div>

            </form>
        </section>
        </div>

    </div>

@endsection
