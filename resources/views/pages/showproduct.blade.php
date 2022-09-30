@extends('layouts.main_base')
@section('content')

<div class="pagetitle">
    <h1>All files records</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Your Files</h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Description</th>
                  {{-- <th scope="col">File</th> --}}
                  <th scope="col">View</th>
                  <th scope="col">Download</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $data)
                    <tr>
                        <th scope="row">{{$data->id}}</th>
                        <td>{{$data->name}}</td>
                        <td>{{$data->description}}</td>
                        {{-- <td>{{$data->file}}</td> --}}
                        <td> <a href="{{url('/view', $data->id)}}">View</a></td>
                        <td> <a href="{{url('/download', $data->file)}}">Download</a></td>
                    </tr>
                @endforeach

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection