@extends('layouts.backend.app')
@section('content')
<div class="col-div-12">

    <div class="box-12">

    </div>
    <div class="content-box">
        <div class="row">
            <div class="col-sm-6">
                <p class="text-danger fs-4 fw-bold">Total Banners({{ $banners->count() }}) </p>
            </div>
            
            <div class="col-sm-6">
                <span><a href="{{ route('admin.banner.create') }}"
                        class="text-decoration-none text-light px-3 py-2 bg-danger float-sm-end rounded">Create</a></span>
            </div>
        </div>
        <br />
        <div class="table-responsive">

        
        <table class="table table-bordered">
            <tr>
                <th>Sl.no.</th>
                <th class="text-center">Banner Image</th>
               
                <th>Action</th>
            </tr>
            @foreach ($banners as $key =>$banner)
                
           
            <tr>
                <td>{{ ++$key }}</td>
                <td class="text-center">
                    <img src="{{ asset('storage/' . $banner->banner) }}" alt="image" style="width: 9rem;height:5rem">
                </td>
               
              
                <td class="d-flex"><a href="{{ route('admin.banner.edit',['id'=>$banner->id]) }}" class="mt-2"><i class="fa-solid fa-pen-to-square fa-lg text-info"
                            id="icon"></a></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <form action="{{ route('admin.banner.delete',['id'=>$banner->id]) }}" method="post">
                                @csrf
                                @method('delete')
                    <button type="submit" class="btn"><i class="fa-solid fa-trash fa-lg" id="icon1" onclick="return confirm('Are you sure want to delete this Banner?')"></i></button>
                </form>
                    
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
</div>
@endsection