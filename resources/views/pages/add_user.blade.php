@extends('layouts.main_base')
@section('content')

@php
    $user_session_details = Session::get('user_session');
@endphp

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add a New User</h2>
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
                        <form id="demo-form" action="{{route('add_new_user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               <div class="col-md-6 mb-4">
                                    <label for="txt_firstname">First Name</label>
                                    <input type="text" id="txt_firstname" class="form-control" name="txt_firstname" value="{{ old('txt_firstname') }}"/>
                                    <span class="text-danger">@error('txt_firstname') {{ $message }} @enderror</span>
                               </div>
                               <div class="col-md-6 mb-4">
                                    <label for="txt_lastname">Last Name</label>
                                    <input type="text" id="txt_lastname" class="form-control" name="txt_lastname" value="{{ old('txt_lastname') }}"/>
                                    <span class="text-danger">@error('txt_lastname') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-4">
                                     <label for="txt_email">Email</label>
                                     <input type="email" id="txt_email" class="form-control" name="txt_email" value="{{ old('txt_email') }}"/>
                                     <span class="text-danger">@error('txt_email') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-4 mb-4">
                                     <label for="txt_city">City</label>
                                     <input type="text" id="txt_city" class="form-control" name="txt_city" value="{{ old('txt_city') }}"/>
                                     <span class="text-danger">@error('txt_city') {{ $message }} @enderror</span>
                                 </div>
                                <div class="col-md-3 mb-4">
                                     <label for="txt_role">User Role</label>
                                     <select class="select2_single form-control" tabindex="-1" name="txt_role" id="txt_role">
                                        <option disabled selected value="{{ old('txt_role') }}">Select Role</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Basic">Basic</option>
                                     </select>
                                     <span class="text-danger">@error('txt_role') {{ $message }} @enderror</span>
                                 </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-4">
                                     <label for="txt_phone_number">Phone Number</label>
                                     <input type="text" id="txt_phone_number" class="form-control" name="txt_phone_number" value="{{ old('txt_phone_number') }}"/>
                                     <span class="text-danger">@error('txt_phone_number') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-4 mb-4">
                                     <label for="txt_profession">Profession</label>
                                     <input type="text" id="txt_profession" class="form-control" name="txt_profession" value="{{ old('txt_profession') }}"/>
                                     <span class="text-danger">@error('txt_profession') {{ $message }} @enderror</span>
                                 </div>
                                 <div class="col-md-3 mb-4">
                                     <label for="txt_user_photo">Upload Photo</label><br>
                                     <input type="file" id="txt_user_photo" name="txt_user_photo" value="{{ old('txt_user_photo') }}" onChange="loadUserImage(this);"/>
                                     <span class="text-danger">@error('txt_user_photo') {{ $message }} @enderror</span>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="txt_address">Address</label>
                                    {{-- <textarea id="message"  class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="20"></textarea> --}}
                                    <textarea id="txt_address"  class="form-control" name="txt_address" data-parsley-trigger="keyup">{{ old('txt_address') }}</textarea>
                                    <span class="text-danger">@error('txt_address') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-3">
                                    <img id="uploaded_user_image" alt="">
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


        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Users <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                {{-- <p class="text-muted font-13 m-b-30">
                                The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                                </p> --}}
                                <table id="datatable-buttons my_table1" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Role</th>
                                        <th>Phone</th>
                                        <th>Profession</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($all_users as $users)
                                            <tr>
                                                <td>{{$users->firstname}} {{$users->lastname}}</td>
                                                <td>{{$users->email}}</td>
                                                <td>{{$users->city}}</td>
                                                <td>{{$users->role}}</td>
                                                <td>{{$users->phone_number}}</td>
                                                <td>{{$users->profession}}</td>
                                                <td>{{$users->address}}</td>
                                                <td class="action_td">
                                                    <a href="{{url('edit_user', $users->id)}}" class="text-primary edit_button"><i class="fa fa-edit"></i></a>
                                                    <form method="POST" action="{{url('delete_user', $users->id)}}">
                                                        @csrf
                                                        <button type="submit" class="text-danger delete_button" data-toggle="tooltip"
                                                        data-placement="top" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

<script>
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
        alert("Link copied to clipboard");
    }

    function myFunction() {
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/

    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
    }
</script>

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



{{-- <script>
    $('#my_table1').DataTable({
        "responsive": true,
        "searching": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 7, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#my_table1_wrapper .col-md-6:eq(0)');
</script> --}}

@endsection
