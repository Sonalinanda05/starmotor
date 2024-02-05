@extends('layouts.backend.app')
@section('content')
    <div class="col-div-12">

        <div class="box-12">

        </div>
        <div class="content-box">

            <table class="table table-bordered">
                <tr>
                    <th>Sl.no.</th>
                    <th>Name</th>
                    <th>Car Name</th>
                    <th>Car Model</th>
                    <th>Car Price</th>
                    <th>Email</th>
                    <th>Phone</th>

                    <th>Booked on</th>
                    <th>Reply</th>
                    <th>Action</th>
                </tr>
                @foreach ($bookCar as $key => $bookCar)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $bookCar->name }}</td>
                        <td>
                            {{ $bookCar->cars->name }}
                        </td>

                        <td>
                            {{ $bookCar->cars->model }}
                        </td>
                        <td>
                           
                            {{ number_format($bookCar->cars->sell_price, 2, '.', ',') }}
                        </td>
                        <td>{{ $bookCar->email }}</td>
                        <td>{{ $bookCar->phone }}</td>


                        <td>{{ $bookCar->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.bookCar.reply', ['id' => $bookCar->id]) }}"><button type="button"
                                    class="btn btn-info  m-3">Reply</button></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.bookCar.delete', ['id' => $bookCar->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn"><i class="fa-solid fa-trash fa-lg" id="icon1"
                                        onclick="return confirm('Are you sure want to delete this enquiry?')"></i></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
