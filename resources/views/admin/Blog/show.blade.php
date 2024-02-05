@extends('layouts.backend.app')
@section('content')
    <div class="col-div-12">

        <div class="box-12">

        </div>
        <div class="content-box">
            <p>bigest project <span><a href="{{ route('admin.blog.view') }}">View All Blogs</a></span></p>
            <br />
            <div style="height:35rem;overflow-y:scroll">


                <div class="container">
                    <div class="row">
                        
                        <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid" alt="..." style="height: 25rem">
                    </div>

                    <div class="row text-light mt-3 ms-3">
                        {{ $blog->title }}
                    </div>

                    <div class="row text-light mt-3 mb-5">
                        {!! $blog->description !!}
                    </div>
                </div>

            </div>
        </div>
        
    @endsection
