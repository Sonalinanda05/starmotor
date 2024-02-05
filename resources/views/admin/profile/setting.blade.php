@extends('layouts.backend.app')

@section('content')
    <div class="row">
        <h2 class="text-light ms-2">Update Profile:</h2>
    </div><br>

    <div style="height: 35rem; overflow-y:scroll; overflow-x:hidden" class="ms-3">
        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
        
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ old('name', Auth::user()->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email', Auth::user()->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Current password</label>
                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Current password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="password" class="form-label">New password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter New password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter mobile no." value="{{ old('phone', Auth::user()->phone) }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
        
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Image" accept="image/*">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if(Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Current Image" style="max-width: 200px; max-height: 100px; margin-top: 10px;">
                        @endif
                    </div>
                </div>
            </div>
        
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-danger btn-lg">Update</button>
                <button type="reset" class="btn btn-secondary btn-lg ms-4">Clear</button>
            </div>
        </form>
        
    </div>
@endsection
