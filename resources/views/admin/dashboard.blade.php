@extends('layouts.backend.app')
@section('content')
    <div class="col-div-3">
        <div class="box">
            <p>{{ $TotalUsers }}<br /><span>Customers</span></p>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="col-div-3">
        <div class="box">
            <p>{{ $soldCars }}<br /><span>Total Sold Cars</span></p>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="col-div-3">
        <div class="box">
            <p>{{ $carsforSale }}<br /><span>Cars for Sale</span></p>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="col-div-3">
        <div class="box">
            <p>{{ $TotalCars }}<br /><span>Total Buy Cars</span></p>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="clearfix"></div>
    <br /><br />
    <div class="col-div-12">
        
            <div class="content-box">
                <p>Recent Booked Car for Test Drive <span><a href="{{ route('admin.bookCar.view') }}">View All</a></span></p>
                <br />
                {{-- <table>
                    <tr>
                        <th>company</th>
                        <th>contact</th>
                        <th>country</th>
                    </tr>
                    <tr>
                        <td>limeli8 pvt ltd</td>
                        <td>1234567893</td>
                        <td>delhi</td>
                    </tr>
                    <tr>
                        <td>scius pvt ltd</td>
                        <td>7894561232</td>
                        <td>mumbai</td>
                    </tr>
                    <tr>
                        <td>imfomanav pvt ltd</td>
                        <td>123456789</td>
                        <td>chenai</td>
                    </tr>
                    <tr>
                        <td>ratna pvt ltd</td>
                        <td>99633555</td>
                        <td>bbsr</td>
                    </tr>
                </table> --}}

                <div class="table-responsive">
                    <table class="table-bordered">
                        <thead>
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
                               
                            </tr>
                        </thead>
                        <tbody>
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
                                    class="btn btn-info m-3">Reply</button></a>
                        </td>
                        
                    </tr>
                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
       
    </div>
    {{-- <div class="col-div-4">
        <div class="box-4">
            <div class="content-box">
                <p>Total project <span><a href>View All</a></span></p>
                <div class="circle-wrap ">
                    <div class="circle ">
                        <div class="mask full">
                            <div class="fill"></div>
                        </div>
                        <div class="mask half">
                            <div class="fill"></div>
                        </div>
                        <div class="inside-circle">70%</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
