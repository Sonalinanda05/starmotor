@extends('layouts.backend.app')
@section('content')

<div class="row">
    <h2 class="text-light ms-2">Edit User:</h2>
</div><br>
<form action="{{route('admin.users.update',['id'=>$users->id])}}" method="post">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{ $users->name }}"
           >

        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{ $users->email }}"
            >

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Phone Number</label>
          <input type="text" class="form-control" name="phone" id="exampleInputEmail1"
          value="{{ $users->phone }}" maxlength="10" >

        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Password</label>
          <input type="password" class="form-control" name="password"
            id="exampleInputEmail1">

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Confirm
            Password</label>
          <input type="password" class="form-control"
            id="exampleInputEmail1"  name="password_confirmation">

        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Upload Image</label>
          <input type="file" name="image" class="form-control" id="exampleInputEmail1"
            >

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
            <label for="role_id" class="form-label">Role_id</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="role_id">

                    <option value="1" @if ($users && $users->role_id == '1') selected @endif>Admin</option>
                    <option value="2" @if ($users && $users->role_id == '2') selected @endif>User</option>

                </select>
            </div>
           
            @error('role_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
      
    </div>

    <div class="d-flex justify-content-center mt-5">
      <button type="submit" class="btn btn-danger btn-lg">Update</button>
      <button type="reset" class="btn btn-secondary btn-lg ms-4">Clear</button>
      <a href="{{ route('admin.users.view') }}"><button type="button" class="btn btn-primary btn-lg ms-4">View
          User</button></a>
    </div>
  </form>

@endsection