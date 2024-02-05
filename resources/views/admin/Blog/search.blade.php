@extends('layouts.backend.app')
@section('content')
    <div class="col-div-12">

        <div class="box-12">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-danger fs-4 fw-bold">Total Blogs({{ $blogs->count() }}) </p>
                </div>
                <div class="col-sm-5">
                    <form action="{{ route('admin.blog.search') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search"
                                aria-label="Recipient's username" name="search">
                            <button class="btn btn-pos" type="submit" id="button-addon2"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3">
                    <span><a href="{{ route('admin.blog.create') }}"
                            class="text-decoration-none text-light px-3 py-2 bg-danger float-sm-end rounded">Create</a></span>
                </div>
            </div>
            <br />
            <div class="table-responsive">



                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl.no.</th>

                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>


                    </thead>
                    <tbody>
                        @foreach ($blogs as $key => $blog)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="image" style="width: 9rem; height: 5rem">
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{!! Illuminate\Support\Str::limit($blog->description, 30) !!}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.blog.edit', ['id' => $blog->id]) }}" class="mt-2">
                                        <i class="fa-solid fa-pen-to-square fa-lg text-info" id="icon"></i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <form action="{{ route('admin.blog.delete', ['id' => $blog->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-trash fa-lg" id="icon1"
                                                onclick="return confirm('Are you sure want to delete this Blog ?')"></i>
                                        </button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('admin.blog.show', ['id' => $blog->id]) }}" class="mt-2">
                                        <i class="fa-solid fa-eye fa-lg" id="icon2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>




            </div>
        </div>
    @endsection
