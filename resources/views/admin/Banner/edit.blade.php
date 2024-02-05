@extends('layouts.backend.app')

@section('content')
    <div class="row">
        <h2 class="text-light ms-2">Edit Banner:</h2>
    </div><br>

    <div style="height: 35rem; overflow-y:scroll; overflow-x:hidden" class="ms-3">
        <form action="{{ route('admin.banner.update',['id'=>$banners->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="banner_image" id="image" placeholder="Image"
                            accept="image/*" required>
                            @if($banners->banner)
                            <div>
                                <img src="{{ asset('storage/' . $banners->banner) }}" alt="Current Image" style="max-width: 200px; max-height: 100px; margin-top: 10px;">
                            </div>
                           
                        @endif
                        @error('banner_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
              
            </div>

            

            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-danger btn-lg">Update Banner</button>
                <button type="reset" class="btn btn-secondary btn-lg ms-4">Clear</button>
                <a href="{{ route('admin.banner.view') }}"><button type="button" class="btn btn-primary btn-lg ms-4">View
                        Banners</button></a>
            </div>

        </form>
    </div>
@endsection