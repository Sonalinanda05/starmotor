@extends('layouts.backend.app')
@section('content')
    <div class="col-div-12">

        <div class="box-12">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p class="text-danger fw-bold fs-5">Total Buy Cars({{ $Total_Cars->count() }})&nbsp;&nbsp; Total Cars for sale({{ $Total_Cars_sale }})&nbsp;&nbsp; Total Sold Cars({{$Sold_Cars}})</p>
                </div>
                <div class="col-sm-5">
                    <form action="{{ route('admin.car.search') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search"
                                aria-label="Recipient's username" name="search">
                            <button class="btn btn-pos" type="submit" id="button-addon2"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-1">
                    <span><a href="{{ route('admin.car.create') }}"
                            class="text-decoration-none text-light px-3 py-2 bg-danger float-sm-end rounded">Create</a></span>
                </div>
            </div>
            <br />
            <div style="height:35rem;overflow-y:scroll">


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl.no.</th>
                                <th>Status</th>
                                <th>image</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>badge</th>
                                <th>warranty</th>
                                <th>no.of free service</th>
                                <th>location</th>
                                <th>car age</th>
                                <th>Fuel Type</th>
                                <th>Kilometers Driven</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>how many owners</th>
                                <th>Model</th>
                                <th>Body Type</th>
                                <th>Transmission</th>
                                <th>Action</th>
    
                            </tr>
                        </thead>
                       
                        @foreach ($cars as $key => $car)
                        <tbody>
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    @if ($car->status == 'Not Sold')
                                        <span class="bg-danger">{{ $car->status }}</span>
                                    @elseif ($car->status == 'Sold')
                                        <span class="bg-success ps-3 pe-3 pt-1 pb-1 mt-2">{{ $car->status }}</span>
                                    @endif
                                </td>

                                <td>
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="image" style="width: 9rem;height:5rem">
                                </td>
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->badge }}</td>
                                <td>{{ $car->warranty }}</td>
                                <td>{{ $car->free_service_count }}</td>
                                <td>{{ $car->location }}</td>
                                <td>{{ $car->car_age }}</td>
                                <td>{{ $car->fuel_type }}</td>
                                <td>{{ $car->kilometers_driven }}</td>
                                <td>{{ $car->price }}</td>
                                <td>{{ $car->color }}</td>
                                <td>{{ $car->owners_count }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->body_type }}</td>
                                <td>{{ $car->transmission }}</td>
                                <td class="d-flex"><a href="{{ route('admin.car.edit', ['id' => $car->id]) }}"
                                        class="mt-2"><i class="fa-solid fa-pen-to-square fa-lg text-info"
                                            id="icon"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <form action="{{ route('admin.car.delete', ['id' => $car->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn"><i class="fa-solid fa-trash fa-lg"
                                                id="icon1"
                                                onclick="return confirm('Are you sure want to delete this Car Details ?')"></i></button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('admin.car.edit', ['id' => $car->id]) }}" class="mt-2"><i
                                            class="fa-solid fa-eye fa-lg" id="icon2"></i></a>


                                </td>
                            </tr>
                        </tbody>
                           
                        @endforeach
                    </table>


                </div>

            </div>
        </div>
        {{-- @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const carStatusSelects = document.querySelectorAll('.car-status');
    
                // Function to update the status in the backend
                const updateStatus = (carId, newStatus) => {
                    fetch(`/admin/car/update-status/${carId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ status: newStatus }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response as needed
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                };
    
                // Add event listener to each car status dropdown
                carStatusSelects.forEach(select => {
                    const carId = select.getAttribute('data-car-id');
    
                    // Retrieve status from local storage
                    const storedStatus = localStorage.getItem(`car_status_${carId}`);
                    if (storedStatus) {
                        select.value = storedStatus;
                    }
    
                    select.addEventListener('change', function () {
                        const newStatus = this.value;
    
                        // Update status in the backend
                        updateStatus(carId, newStatus);
    
                        // Store the selected status in local storage
                        localStorage.setItem(`car_status_${carId}`, newStatus);
                    });
                });
            });
        </script>
        @endpush --}}
    @endsection
