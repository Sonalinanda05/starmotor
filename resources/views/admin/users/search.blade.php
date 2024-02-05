@extends('layouts.backend.app')
@section('content')
    <div class="col-div-12">

        <div class="box-12">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-danger fs-4 fw-bold">Total Users({{ $users->count() }}) </p>
                </div>
                <div class="col-sm-5">
                    <form action="{{ route('admin.users.search') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search"
                                aria-label="Recipient's username" name="search">
                            <button class="btn btn-pos" type="submit" id="button-addon2"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3">
                    <span><a href="{{ route('admin.users.create') }}"
                            class="text-decoration-none text-light px-3 py-2 bg-danger float-sm-end rounded">Create</a></span>
                </div>
            </div>

            <br />
            <table>
                <tr>
                    <th>Sl.no.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td class="d-flex"><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="mt-2"><i
                                    class="fa-solid fa-pen-to-square fa-lg text-info"
                                    id="icon"></a></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <form action="{{ route('admin.users.delete', ['id' => $user->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn"><i class="fa-solid fa-trash fa-lg" id="icon1"
                                        onclick="return confirm('Are you sure want to delete this User?')"></i></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
