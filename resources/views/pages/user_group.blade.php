@extends('layouts.main_base')
@section('content')

<div class="pagetitle">
    <h1>Change User Role</h1>
</div><!-- End Page Title -->
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            {{-- <h5 class="card-title">Add New User</h5> --}}

            <!-- Add User Form -->
            <form class="row g-3 mt-2" action="{{route('assign_new_group')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="txt_user_id" class="form-label">Users</label>
                    <select id="txt_user_id" class="form-select" name="txt_user_id">
                        <option disabled="disabled" selected>Select User</option>
                        @foreach($all_users as $users)
                            <option value="{{ $users->id}}">
                                {{ $users->firstname }} {{ $users->lastname }} &nbsp; &nbsp; &nbsp; &nbsp; Role - {{ $users->role }}
                            </option>
                        @endforeach
                    </select>
                    {{-- <span class="text-danger">@error('txt_user_group') {{ $message }} @enderror</span> --}}
                </div>
                <div class="col-md-6">
                    <label for="txt_user_new_group" class="form-label">User Roles</label>
                    <select id="txt_user_new_group" class="form-select" name="txt_user_new_group">
                        <option disabled="disabled" selected>Select Role</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="Basic">Basic</option>
                    </select>
                    {{-- <span class="text-danger">@error('txt_user_group') {{ $message }} @enderror</span> --}}
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form><!-- End Add User Form -->

          </div>
        </div>

      </div>

    </div>
</section>

@endsection