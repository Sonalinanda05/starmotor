@extends('layouts.backend.app')

@section('content')
    <div class="row">
        <h2 class="text-light ms-2">Add New Car:</h2>
    </div><br>

    <div style="height: 32rem; overflow-y:scroll; overflow-x:hidden" class="ms-3">
        <form action="{{ route('admin.car.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Registration Number</label>
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Registration_Number" id="regd"
                                placeholder="Enter Registration Number" required>
                            </div>
                            {{-- <div class="col-sm-3 float-start">
                               <button type="button" id="fetchCarDetails" class="btn btn-primary ">Fetch Car Details</button>
                            </div> --}}
                        </div>
                       
                        @error('Registration_Number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

              
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Image"
                            accept="image/*" required>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gallery_image" class="form-label">Gallery Image</label>
                        <input type="file" class="form-control" name="gallery_image[]" id="gallery_image"
                            accept="image/*" placeholder="Gallery Image" multiple required>
                        @error('gallery_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                            required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand"
                            required>
                        @error('brand')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="badge" class="form-label">Badge</label>
                        <input type="text" class="form-control" name="badge" id="badge" placeholder="Badge"
                            required>
                        @error('badge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="warranty" class="form-label">Warranty</label>
                        <input type="text" class="form-control" name="warranty" id="warranty" placeholder="Warranty"
                            required>
                        @error('warranty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="free_service_count" class="form-label">No. of Free Service</label>
                        <input type="number" class="form-control" name="free_service_count" id="free_service_count"
                            placeholder="No. of Free Service" required>
                        @error('free_service_count')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location"
                            required>
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="car_age" class="form-label">Car was bought in year?</label>
                        <input type="integer" class="form-control" name="car_age" id="car_age" placeholder="Car Age"
                            required>
                        @error('car_age')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fuel_type" class="form-label">Fuel Type</label>
                        <input type="text" class="form-control" name="fuel_type" id="fuel_type"
                            placeholder="Fuel Type" required>
                        @error('fuel_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kilometers_driven" class="form-label">Kilometers Driven</label>
                        <input type="number" class="form-control" name="kilometers_driven" id="kilometers_driven"
                            placeholder="Kilometers Driven" required>
                        @error('kilometers_driven')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="price" class="form-label">Cost Price</label>
                        <input type="text" class="form-control" name="cost_price" id="price" placeholder="cost price"
                            required>
                        @error('cost_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="price" class="form-label">Sell Price</label>
                        <input type="text" class="form-control" name="sell_price" id="price" placeholder="sell price"
                            required>
                        @error('sell_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" name="color" id="color" placeholder="Color"
                            required>
                        @error('color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="owners_count" class="form-label">no.of Owners</label>
                        <input type="text" class="form-control" name="owners_count" id="owners_count"
                            placeholder="How Many Owners" required>
                        @error('owners_count')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" name="model" id="model" placeholder="Model"
                            required>
                        @error('model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="body_type" class="form-label">Body Type</label>
                        <input type="text" class="form-control" name="body_type" id="body_type"
                            placeholder="Body Type" required>
                        @error('body_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="transmission" class="form-label">Transmission</label>
                        <input type="text" class="form-control" name="transmission" id="transmission"
                            placeholder="Transmission" required>
                        @error('transmission')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="status">

                                <option value="Not Sold">Not Sold</option>
                                <option value="Sold">sold</option>

                            </select>
                        </div>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-danger btn-lg">Add Car</button>
                <button type="reset" class="btn btn-secondary btn-lg ms-4">Clear</button>
                <a href="{{ route('admin.car.view') }}"><button type="button" class="btn btn-primary btn-lg ms-4">View
                        Cars</button></a>
            </div>

        </form>
    </div>
   
@endsection
