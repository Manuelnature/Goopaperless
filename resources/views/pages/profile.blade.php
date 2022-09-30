@extends('layouts.main_base')
@section('content')


    @php
        $user_session_details = Session::get('user_session');
    @endphp

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            {{-- <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
                </div>
            </div>
            </div> --}}

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>My Profile <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            {{-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li> --}}
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    @if ($user_session_details[0]->photo != "" || $user_session_details[0]->photo != NULL)
                                        <img class="img-responsive avatar-view" src="{{asset('assets/img/profiles')}}/{{ $user_session_details[0]->photo }}" alt="Profile" title="Change the Profile">
                                    @else
                                        <img class="img-responsive avatar-view" src="{{asset('assets/img/profile.jpg')}}" alt="Profile" title="Change the Profile">
                                    @endif
                                    {{-- <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar"> --}}
                                    </div>
                                </div>
                                <h3>{{ $user_session_details[0]->firstname }} {{ $user_session_details[0]->lastname }}</h3>

                                <ul class="list-unstyled user_data">
                                    {{-- <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA --}}
                                    </li>

                                    <li><i class="fa fa-briefcase user-profile-icon"></i>   {{ $user_session_details[0]->profession }}</li>

                                    <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>   {{ $user_session_details[0]->email }}</li>
                                </ul>

                                {{-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> --}}
                                <br />

                                {{-- <!-- start skills -->
                                <h4>Skills</h4>
                                <ul class="list-unstyled user_data">
                                    <li>
                                    <p>Web Applications</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                    </li>
                                    <li>
                                    <p>Website Design</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                                    </div>
                                    </li>
                                    <li>
                                    <p>Automation & Testing</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                                    </div>
                                    </li>
                                    <li>
                                    <p>UI / UX</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                    </li>
                                </ul>
                                <!-- end of skills --> --}}
                            </div>

                            <div class="col-md-9 col-sm-9 ">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Overview</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Edit Profile</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Change Password</a>
                                    </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                                        <!-- start recent activity -->
                                        <ul class="messages">
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Full Name</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->firstname }} {{ $user_session_details[0]->lastname }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Profession</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->profession }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                    <div class="message_wrapper">
                                                    <h4 class="heading">Role</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->role }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                <div class="message_wrapper">
                                                    <h4 class="heading">City</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->city }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Address</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->address }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Phone Number</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->phone_number }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                            <li>
                                                {{-- <img src="images/img.jpg" class="avatar" alt="Avatar"> --}}
                                                <div class="message_wrapper">
                                                    <h4 class="heading">Email</h4>
                                                    <blockquote class="message">{{ $user_session_details[0]->email }}</blockquote>
                                                    <br />
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- end recent activity -->

                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 ">
                                                <div class="x_panel">

                                                    <div class="x_content">

                                                        <!-- start form for validation -->
                                                        <form id="demo-form" action="{{ route('update_user_profile') }}" method="post"  enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <input type="hidden" name="txt_user_id" class="form-control" id="txt_user_id" value="{{ $user_session_details[0]->id }}">
                                                               <div class="col-md-6 mb-4">
                                                                    <label for="txt_firstname">First Name</label>
                                                                    <input type="text" id="txt_firstname" class="form-control" name="txt_firstname" value="{{ $user_session_details[0]->firstname }}"/>
                                                                    <span class="text-danger">@error('txt_firstname') {{ $message }} @enderror</span>
                                                               </div>
                                                               <div class="col-md-6 mb-4">
                                                                    <label for="txt_lastname">Last Name</label>
                                                                    <input type="text" id="txt_lastname" class="form-control" name="txt_lastname" value="{{ $user_session_details[0]->lastname }}"/>
                                                                    <span class="text-danger">@error('txt_lastname') {{ $message }} @enderror</span>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                               <div class="col-md-6 mb-4">
                                                                    <label for="txt_email">Email</label>
                                                                    <input type="text" id="txt_email" class="form-control" name="txt_email" value="{{ $user_session_details[0]->email }}"/>
                                                                    <span class="text-danger">@error('txt_email') {{ $message }} @enderror</span>
                                                               </div>
                                                               <div class="col-md-6 mb-4">
                                                                    <label for="txt_profession">Last Name</label>
                                                                    <input type="text" id="txt_profession" class="form-control" name="txt_profession" value="{{ $user_session_details[0]->profession }}"/>
                                                                    <span class="text-danger">@error('txt_profession') {{ $message }} @enderror</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-4">
                                                                     <label for="txt_role">Role</label>
                                                                     <input type="text" id="txt_role" class="form-control" name="txt_role" value="{{ $user_session_details[0]->role }}" readonly/>
                                                                     <span class="text-danger">@error('txt_role') {{ $message }} @enderror</span>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                     <label for="txt_city">City</label>
                                                                     <input type="text" id="txt_city" class="form-control" name="txt_city" value="{{ $user_session_details[0]->city }}"/>
                                                                     <span class="text-danger">@error('txt_city') {{ $message }} @enderror</span>
                                                                 </div>
                                                             </div>
                                                             <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <label for="txt_address">Address</label>
                                                                    <textarea id="txt_address"  class="form-control" name="txt_address" data-parsley-trigger="keyup">{{ $user_session_details[0]->address }}</textarea>
                                                                    <span class="text-danger">@error('txt_address') {{ $message }} @enderror</span>

                                                                </div>
                                                             </div>
                                                             <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="txt_phone_number">Phone Number</label>
                                                                    <input type="text" id="txt_phone_number" class="form-control" name="txt_phone_number" value="{{ $user_session_details[0]->phone_number }}"/>
                                                                     <span class="text-danger">@error('txt_phone_number') {{ $message }} @enderror</span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="hidden" name="txt_previous_photo" value="{{$user_session_details[0]->photo }}">

                                                                    <label for="txt_update_user_photo">Change Profile Photo</label><br>
                                                                    <input type="file" id="txt_update_user_photo" name="txt_update_user_photo" value="{{ old('txt_update_user_photo') }}" onChange="loadUserImage(this);"/>
                                                                    {{-- <span class="text-danger">@error('txt_update_user_photo') {{ $message }} @enderror</span> --}}

                                                                    <div class="">
                                                                        <img id="uploaded_user_image" src="{{ asset('assets/img/profiles')}}/{{ $user_session_details[0]->photo}}" >
                                                                    </div>
                                                                </div>
                                                             </div>

                                                            <div class="ln_solid"></div>
                                                            <div class="form-group row">
                                                                <div class="col-md-9 col-sm-9  offset-md-3">
                                                                    {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}
                                                                    <button type="submit" class="btn btn-success">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- end form for validations -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                        <form id="demo-form" action="{{ route('change_password') }}" method="post"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="txt_user_id" class="form-control" id="txt_user_id" value="{{ $user_session_details[0]->id }}">
                                               <div class="col-md-12 mb-4">
                                                    <label for="txt_current_password">Current Password</label>
                                                    <input type="password" id="txt_current_password" class="form-control" name="txt_current_password" />
                                                    <span class="text-danger">@error('txt_current_password') {{ $message }} @enderror</span>
                                               </div>
                                            </div>

                                            <div class="row">
                                               <div class="col-md-6 mb-4">
                                                    <label for="txt_new_password">New Password</label>
                                                    <input type="password" id="txt_new_password" class="form-control" name="txt_new_password"/>
                                                    <span class="text-danger">@error('txt_new_password') {{ $message }} @enderror</span>
                                               </div>
                                               <div class="col-md-6 mb-4">
                                                    <label for="txt_confirm_new_password">Re-Enter New Password</label>
                                                    <input type="password" id="txt_confirm_new_password" class="form-control" name="txt_confirm_new_password" />
                                                    <span class="text-danger">@error('txt_confirm_new_password') {{ $message }} @enderror</span>
                                                </div>
                                            </div>


                                            <div class="ln_solid"></div>
                                            <div class="form-group row">
                                                <div class="col-md-9 col-sm-9  offset-md-3">
                                                    {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}
                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    @section('LoadImage_JS')
        <script src="{{ asset('assets/my_js/load_image.js') }}" ></script>
    @endsection


    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
   {{-- <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- morris.js -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script> --}}


@endsection
