@extends('layouts.backend.app')

@section('content')
    <div class="row">
        <h2 class="text-light ms-2">Edit Blog:</h2>
    </div><br>

    <div class="container ms-3" style="height:35rem;overflow-y:scroll">
        <form action="{{ route('admin.blog.update',['id'=>$blogs->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Image"
                            accept="image/*">
                            @if($blogs->image)
                            <div>
                                <img src="{{ asset('storage/' . $blogs->image) }}" alt="Current Image" style="max-width: 200px; max-height: 100px; margin-top: 10px;">
                            </div>
                           
                        @endif
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" class="form-control fs-4" id="exampleInputTitle" aria-describedby="emailHelp"
                            name="title" value="{{ $blogs->title }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <div>
                            <textarea class="ckeditor" placeholder="Leave a comment here" id="description" name="description">{{ $blogs->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
    
                </div>
    
                </div>
               



            <div class="d-flex justify-content-center mt-4 mb-3">
                <button type="submit" class="btn btn-danger btn-lg">Update</button>
                <button type="reset" class="btn btn-secondary btn-lg ms-4">Clear</button>
                <a href="{{ route('admin.blog.view') }}"><button type="button" class="btn btn-primary btn-lg ms-4">View
                        Blogs</button></a>
            </div>

        </form>
    </div>
    @push('scripts')
        <script src="/ckeditor/ckeditor.js"></script>
    @endpush
@endsection
