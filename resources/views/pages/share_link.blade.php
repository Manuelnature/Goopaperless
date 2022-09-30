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
                        <h2>Share link here</h2>
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
                        <form id="demo-form" action="{{route('share_link')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               <div class="col-md-6 mb-4">
                                    <label for="txt_link">Link </label>
                                    <input type="text" id="txt_link" class="form-control" name="txt_link" value="{{ old('txt_link') }}"/>
                                    <span class="text-danger">@error('txt_link') {{ $message }} @enderror</span>
                               </div>
                               <div class="col-md-6 mb-4">
                                    <label for="txt_share_to">Share With</label>
                                    <select class="select2_single form-control" tabindex="-1" name="txt_share_to" id="txt_share_to">
                                        <option disabled selected>Select User</option>
                                        @foreach ($get_all_users as $users)
                                            <option value="{{ $users->firstname }} {{ $users->lastname }}">{{ $users->firstname }} {{ $users->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_share_to') {{ $message }} @enderror</span>
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
                    <h2>My Shared Links <small>Links</small></h2>
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
                                            <th>Description</th>
                                            <th>Get Link</th>
                                            <th>Shared To</th>
                                            <th>Shared At</th>
                                            <th>Shared By</th>
                                            <th>Updated At</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($all_my_shared_links as $my_links)
                                            <tr>
                                                <td scope="row">{{$my_links->description}}</td>
                                                <td>
                                                    <a href="{{$my_links->link}}" class="btn btn-secondary visit">Visit</a>
                                                    <input type="text" id="copy_{{ $my_links->id }}" value="{{$my_links->link}}" class="file_link">
                                                    <button class="btn btn-secondary copy" value="copy" onclick="copyToClipboard('copy_{{ $my_links->id }}')">Copy</button>
                                                </td>
                                                <td>{{$my_links->shared_to}}</td>
                                                <td>{{$my_links->created_at}}</td>
                                                <td>{{$my_links->created_by}}</td>
                                                <td>{{$my_links->updated_at}}</td>
                                                <td>{{$my_links->updated_by}}</td>
                                                <td class="action_td">
                                                <a href="{{url('edit_shared_link', $my_links->id)}}" class="text-primary edit_button"><i class="fa fa-edit"></i></a>
                                                <form method="POST" action="{{route('delete_shared_link', $my_links->id)}}">
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
                        <h2>All Shared<small> Links </small></h2>
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
                                                <th>Description</th>
                                                <th>Get Link</th>
                                                <th>Shared To</th>
                                                <th>Shared At</th>
                                                <th>Shared By</th>
                                                <th>Updated At</th>
                                                <th>Updated By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($get_all_links as $all_links)
                                                <tr>
                                                    <td scope="row">{{$all_links->description}}</td>
                                                    <td>
                                                        <a href="{{$all_links->link}}" class="btn btn-secondary visit">Visit</a>
                                                        <input type="text" id="copy_{{ $all_links->id }}" value="{{$all_links->link}}" class="file_link">
                                                        <button class="btn btn-secondary copy" value="copy" onclick="copyToClipboard('copy_{{ $all_links->id }}')">Copy</button>
                                                    </td>
                                                    <td>{{$all_links->shared_to}}</td>
                                                    <td>{{$all_links->created_at}}</td>
                                                    <td>{{$all_links->created_by}}</td>
                                                    <td>{{$all_links->updated_at}}</td>
                                                    <td>{{$all_links->updated_by}}</td>
                                                    <td class="action_td">
                                                    <a href="{{url('edit_shared_link', $all_links->id)}}" class="text-primary edit_button"><i class="fa fa-edit"></i></a>
                                                    <form method="POST" action="{{route('delete_shared_link', $all_links->id)}}">
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
