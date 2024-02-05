@extends('layouts.backend.app')

@section('content')
    <div class="row">
        <h2 class="text-light ms-2">Reply Here:</h2>
    </div><br>

    <div class="ms-3" style="height: 32rem;overflow-y:scroll">
        <form action="{{ route('admin.bookCar.send', ['id' => $bookCar->id] )}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control fs-4" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email" value="{{ $bookCar->email }}" readonly>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Reply</label>
                <div>
                    <textarea class="ckeditor" placeholder="Leave a comment here" id="reply" name="reply"></textarea>

                </div>
            </div>




            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-danger btn-lg">Send Reply</button>
                <button type="reset" class="btn btn-secondary btn-lg ms-4">Clear</button>
                <a href="{{ route('admin.bookCar.view') }}"><button type="button" class="btn btn-primary btn-lg ms-4">View
                        Bookings</button></a>
            </div>

        </form>
    </div>
    @push('scripts')
        <script src="/ckeditor/ckeditor.js"></script>
    @endpush
@endsection
