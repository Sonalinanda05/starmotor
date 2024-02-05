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
                <th>Email</th>
                <th>Phone</th>
                <th>Registration Number</th>
                <th>Model</th>
                <th>Date</th>
                {{-- <th>Reply</th> --}}
                <th>Action</th>
            </tr>
            @foreach ($sell as $key =>$sell)
                
           
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $sell->name }}</td>
                <td>{{ $sell->email }}</td>
                <td>{{ $sell->phone }}</td>
                <td>{{ $sell->registration }}</td>
                <td>{{ $sell->model }}</td>
                <td>{{ $sell->created_at }}</td>
                {{-- <td>
                   <a href="{{ route('admin.contact.reply',['id'=>$sell->id]) }}"><button type="button" class="btn btn-info">Reply</button></a> 
                </td> --}}
                <td>
                            <form action="{{ route('admin.sell.delete',['id'=>$sell->id]) }}" method="post">
                                @csrf
                                @method('delete')
                    <button type="submit" class="btn"><i class="fa-solid fa-trash fa-lg" id="icon1" onclick="return confirm('Are you sure want to delete this enquiry?')"></i></button>
                </form>
                    
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection