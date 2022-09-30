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
                        <h2>Create a Folder</h2>
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
                        <form id="demo-form" action="{{route('create_folder')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="txt_folder_name">Folder Name</label>
                            <input type="text" id="txt_folder_name" class="form-control" name="txt_folder_name" value="{{ old('txt_folder_name') }}"/>
                            <span class="text-danger">@error('txt_folder_name') {{ $message }} @enderror</span>
                            <br>
                            <label for="txt_folder_description">Description</label>
                            {{-- <textarea id="message"  class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="20"></textarea> --}}

                            <textarea id="txt_folder_description"  class="form-control" name="txt_folder_description" data-parsley-trigger="keyup">{{ old('txt_folder_description') }}</textarea>
                            <span class="text-danger">@error('txt_folder_description') {{ $message }} @enderror</span>

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


        @if ($user_session_details[0]->role == 'Super Admin' || $user_session_details[0]->role == 'Admin')
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All folders <small>deatails</small></h2>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons my_table1" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Folder ID</th>
                                        <th>Folder URL</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                            @foreach ($get_all_folders as $folder)
                                                <tr>
                                                    <td>{{$folder->name}} </td>
                                                    <td>{{$folder->description}}</td>
                                                    <td>{{$folder->folder_id}}</td>
                                                    <td>
                                                        <a href="{{$folder->url}}" class="btn btn-secondary visit">Visit</a>
                                                        <input type="text" id="copy_{{ $folder->id }}" value="{{$folder->url}}" class="folder_url">
                                                        <button class="btn btn-secondary copy" value="copy" onclick="copyToClipboard('copy_{{ $folder->id }}')">Copy</button>
                                                    </td>
                                                    <td class="action_td">
                                                        {{-- <a href="{{url('edit_user', $folder->id)}}" class="text-primary edit_button"><i class="ri-ball-pen-fill"></i></a> --}}
                                                        <form method="POST" action="{{url('delete_folder', $folder->id)}}">
                                                            @csrf
                                                            <button type="submit" class="text-danger delete_button" data-toggle="tooltip"
                                                            data-placement="top" data-original-title="Delete"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                    <tbody>

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


-- jQuery -->
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
