<x-layout>
    <div class="container my-4">
        <div class="row gutters">

            {{-- account of the user --}}
            <div class=" col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body my-4">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar my-4">
                                    <img src="{{ asset('images/logo/logo.png') }}" alt="logo image">
                                </div>
                                <h5 class="user-name">{{ Auth::user()->name }}</h5>
                                <h6 class="user-email">{{ Auth::user()->email }}</h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- form to register the user --}}
            <form class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mb-0" action="/student/{{ $student->id }}/update"
                method="POST">
                @csrf
                @method('PUT')

                {{-- Student Details --}}
                <div class="card h-100">
                    <div class="card-body">
                        <h3>Update a Student Details</h3>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Student Details</h6>
                            </div>


                            {{-- Student Name --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="Name">Student Name</label>
                                    <input type="text" class="form-control" id="Name" name="name"
                                        value="{{ $student->name }}" placeholder="Eg. John doe">
                                </div>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            {{-- Age  --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        value="{{ $student->age }}" placeholder="Eg. 24">
                                </div>
                                @error('age')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            {{-- Gender  --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">

                                    <label for="gender">Gender</label>
                                    <select class="form-group form-select" name="gender" id="gender"
                                        value="{{ $student->gender }}">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                @error('gender')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>



                            {{-- Email --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $student->email }}" placeholder="Eg. johndoe123@gmail.com">
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>



                            {{-- Phone Number --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                        placeholder="Eg. 09_________" value="{{ $student->phone_number }}">
                                    @error('phone_number')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>



                            {{-- Location --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <select class="form-group form-select" name="location_id" id="location"
                                        value="{{ $student->location->name }}">
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            {{-- Student status --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="status">Student status</label>
                                    <select class="form-group form-select" name="status" id="status"
                                        value="{{ $student->status }}">
                                        <option value="Fresh">Fresh</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Senior">Senior</option>
                                    </select>
                                </div>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>



                            {{-- Recommended by --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="recommendation">Recommended by</label>
                                    <select class="form-group form-select" name="recommendation" id="recommendation"
                                        value="{{ $student->recommendation }}">
                                        <option value="">No One</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Online Course Ads">Online Course Advertisement</option>
                                        <option value="Online Reviews and Testimonials">Online Reviews and Testimonials
                                        </option>
                                        <option value="Course Previews or Demos">Course Previews or Demos</option>
                                        <option value="Online Communities and Social Media">Online Communities and
                                            Social
                                            Media</option>
                                    </select>
                                </div>
                                @error('recommendation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="Prefference">Preffered Time</label>
                                    <select class="form-group form-select" name="preffered_time" id="Prefference"
                                        value="{{ $student->preffered_time }}">
                                        <option value="Morning">Morning</option>
                                        <option value="Afternoon">Afternoon</option>
                                    </select>
                                </div>
                                @error('preffered_time')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        </div>

                        {{-- preffered_time --}}

                    {{-- remaining payment --}}
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-2">
                                <h6 class="mt-3 mb-2 text-primary">Payment Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="remaining_payment">Remaining Payment</label>
                                    <input type="number" name="remaining_payment" class="form-control"
                                        id="remaining_payment" value="{{ $student->remaining_payment }}">
                                    </input>
                                </div>
                                @error('remaining_payment')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Course Details --}}
                    <div class="card-body">

                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-4">
                                        <div class="text-right">

                                            <button type="submit" id="submit" name="submit"
                                                class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-layout>
