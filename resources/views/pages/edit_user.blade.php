@extends('layouts.main_base')
@section('content')

@php
    $user_session_details = Session::get('user_session');
@endphp

<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ $user_to_edit->firstname }} {{ $user_to_edit->lastname }}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- start form for validation -->
                        <form id="demo-form" action="{{route('update_user', $user_to_edit->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               <div class="col-md-6 mb-4">
                                    <label for="txt_edit_firstname">First Name</label>
                                    <input type="text" id="txt_edit_firstname" class="form-control" name="txt_edit_firstname" value="{{ $user_to_edit->firstname }}"/>
                                    <span class="text-danger">@error('txt_edit_firstname') {{ $message }} @enderror</span>
                               </div>
                               <div class="col-md-6 mb-4">
                                    <label for="txt_edit_lastname">Last Name</label>
                                    <input type="text" id="txt_edit_lastname" class="form-control" name="txt_edit_lastname" value="{{ $user_to_edit->lastname }}"/>
                                    <span class="text-danger">@error('txt_edit_lastname') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-4">
                                     <label for="txt_edit_email">Email</label>
                                     <input type="email" id="txt_edit_email" class="form-control" name="txt_edit_email" value="{{ $user_to_edit->email }}"/>
                                     <span class="text-danger">@error('txt_edit_email') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-4 mb-4">
                                     <label for="txt_edit_city">City</label>
                                     <input type="text" id="txt_edit_city" class="form-control" name="txt_edit_city" value="{{ $user_to_edit->city }}"/>
                                     <span class="text-danger">@error('txt_edit_city') {{ $message }} @enderror</span>
                                 </div>
                                <div class="col-md-3 mb-4">
                                     <label for="txt_edit_role">User Role</label>
                                     <select class="select2_single form-control" tabindex="-1" name="txt_edit_role" id="txt_edit_role">
                                        <option selected value="{{$user_to_edit->role}}">{{$user_to_edit->role}}</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Basic">Basic</option>
                                     </select>
                                     <span class="text-danger">@error('txt_edit_role') {{ $message }} @enderror</span>
                                 </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-4">
                                     <label for="txt_edit_phone_number">Phone Number</label>
                                     <input type="text" id="txt_edit_phone_number" class="form-control" name="txt_edit_phone_number" value="{{$user_to_edit->phone_number}}"/>
                                     <span class="text-danger">@error('txt_edit_phone_number') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-4 mb-4">
                                     <label for="txt_edit_profession">Profession</label>
                                     <input type="text" id="txt_edit_profession" class="form-control" name="txt_edit_profession" value="{{$user_to_edit->profession}}"/>
                                     <span class="text-danger">@error('txt_edit_profession') {{ $message }} @enderror</span>
                                 </div>
                                 <div class="col-md-3 mb-4">
                                     <label for="txt_edit_user_photo">Upload Photo</label><br>
                                     <input type="file" id="txt_edit_user_photo" name="txt_edit_user_photo" value="{{ old('txt_edit_user_photo') }}" onChange="loadUserImage(this);"/>
                                     <span class="text-danger">@error('txt_edit_user_photo') {{ $message }} @enderror</span>
                                 </div>

                                 <input type="hidden" name="txt_previous_photo" value="{{$user_to_edit->photo }}">
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="txt_edit_address">Address</label>
                                    {{-- <textarea id="message"  class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="20"></textarea> --}}
                                    <textarea id="txt_edit_address"  class="form-control" name="txt_edit_address" data-parsley-trigger="keyup">{{ $user_to_edit->address }}</textarea>
                                    <span class="text-danger">@error('txt_edit_address') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-3">
                                    <img id="uploaded_user_image" alt="" src="{{ asset('assets/img/profiles')}}/{{ $user_to_edit->photo}}">
                                </div>
                            </div>

                            <br />
                            <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-9 col-sm-9  offset-md-3">
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- end form for validations -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>

<!-- iCheck -->
{{-- <script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script> --}}
<!-- Datatables -->
<script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

<script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}"></script>

@section('LoadImage_JS')
  <script src="{{ asset('assets/my_js/load_image.js') }}" ></script>
@endsection

@endsection
