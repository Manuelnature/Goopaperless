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
                        <h2>Upload a file</h2>
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
                        <form id="demo-form" action="{{route('upload_file')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               <div class="col-md-4 mb-4">
                                    <label for="txt_file_title">File Name</label>
                                    <input type="text" id="txt_file_title" class="form-control" name="txt_file_title" value="{{ old('txt_file_title') }}"/>
                                    <span class="text-danger">@error('txt_file_title') {{ $message }} @enderror</span>
                               </div>
                               <div class="col-md-4 mb-4">
                                    <label for="txt_folder_id">Select Folder</label>
                                    <select class="select2_single form-control" tabindex="-1" name="txt_folder_id" id="txt_folder_id">
                                        <option disabled selected>Choose Folder</option>
                                        @foreach ($get_all_folders as $folder)
                                            <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_folder_id') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="txt_filename">Select File</label><br>
                                    <input type="file" id="txt_filename" name="txt_filename" value="{{ old('txt_filename') }}"/>
                                    {{-- <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /> --}}
                                    <span class="text-danger">@error('txt_filename') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <br>
                            <label for="txt_description">Description</label>
                            {{-- <textarea id="message"  class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="20"></textarea> --}}
                            <textarea id="txt_description"  class="form-control" name="txt_description" data-parsley-trigger="keyup">{{ old('txt_description') }}</textarea>
                            <span class="text-danger">@error('txt_description') {{ $message }} @enderror</span>

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
                    <h2>All files <small>I have uploaded</small></h2>
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
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            @if ($user_session_details[0]->role == "Super Admin" || $user_session_details[0]->role == "Admin")
                                                <th>View</th>
                                                <th>Download</th>
                                            @endif
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Updated By</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($all_my_uploaded_files as $my_files)
                                            <tr>
                                                <td>{{$my_files->id}}</th>
                                                <td>{{$my_files->title}}</td>
                                                <td>{{$my_files->description}}</td>
                                                @if ($user_session_details[0]->role == "Super Admin" || $user_session_details[0]->role == "Admin")
                                                    <td>
                                                        <a href="{{url('view_file', $my_files->id)}}" class="btn btn-secondary view"><i class="bi bi-eye"></i> View</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('download_file', $my_files->id)}}" class="btn btn-secondary download"><i class="ri-download-cloud-2-line"></i> Download </a>
                                                    </td>
                                                @endif
                                                <td>{{$my_files->created_by}}</td>
                                                <td>{{$my_files->created_at}}</td>
                                                <td>{{$my_files->updated_by}}</td>
                                                <td>{{$my_files->updated_at}}</td>
                                                <td class="action_td">
                                                    <a href="{{url('edit_file', $my_files->id)}}" class="text-primary edit_button"><i class="fa fa-edit"></i></a>
                                                    <form method="POST" action="{{route('delete_file', $my_files->id)}}">
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

        @if ($user_session_details[0]->role == 'Super Admin' || $user_session_details[0]->role == 'Admin')
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All files <small></small></h2>
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
                                    <table id="datatable-buttons my_table1" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                @if ($user_session_details[0]->role == "Super Admin" || $user_session_details[0]->role == "Admin")
                                                    <th>View</th>
                                                    <th>Download</th>
                                                @endif
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Updated By</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($get_all_files as $all_files)
                                                <tr>
                                                    <th scope="row">{{$all_files->id}}</th>
                                                    <td>{{$all_files->title}}</td>
                                                    <td>{{$all_files->description}}</td>
                                                    @if ($user_session_details[0]->role == "Super Admin" || $user_session_details[0]->role == "Admin")
                                                        <td>
                                                            <a href="{{url('view_file', $all_files->id)}}" class="btn btn-secondary view"><i class="bi bi-eye"></i> View</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{url('download_file', $all_files->id)}}" class="btn btn-secondary download"><i class="ri-download-cloud-2-line"></i> Download </a>
                                                        </td>
                                                    @endif
                                                    <td>{{$all_files->created_by}}</td>
                                                    <td>{{$all_files->created_at}}</td>
                                                    <td>{{$all_files->updated_by}}</td>
                                                    <td>{{$all_files->updated_at}}</td>
                                                    <td class="action_td">
                                                        <a href="{{url('edit_file', $all_files->id)}}" class="text-primary edit_button"><i class="fa fa-edit"></i></a>
                                                        <form method="POST" action="{{route('delete_file', $all_files->id)}}">
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
        @endif

    </div>
</div>
<!-- /page content -->

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
