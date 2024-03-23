@include('partials._head')

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


        {{-- form to update the course --}}
        <form class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mb-0" action="/course/{{ $course->id }}/update"
            method="POST">
            @csrf
            @method('PUT')


            {{-- Course Details --}}
            <div class="card h-100">
                <div class="card-body">
                    <h3>Update a Course</h3>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Course Details</h6>
                        </div>


                        {{-- Course Name --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="Name">Course Name</label>
                                <input type="text" class="form-control" id="Name" name="name"
                                    value="{{ $course->name }}" placeholder="Eg. Laravel">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Place  --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="place">Place</label>
                                <input type="text" class="form-control" id="place" name="place"
                                    value="{{ $course->place }}" placeholder="Eg. Megenagna Head Office">
                            </div>
                            @error('place')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>




                        {{-- Start date --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="s_date">Starts Date</label>
                                <input type="date" class="form-control" id="s_date" name="Starting_date"
                                    value="{{ $course->Starting_date }}">
                            </div>
                            @error('Starting_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>



                        {{-- Ending date --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="E_date">Ending date</label>
                                <input type="date" class="form-control" id="E_date" name="Ending_date"
                                    value="{{ $course->Ending_date }}">
                                @error('Ending_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>

                         {{-- preffered time --}}
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-2">
                            <p class="text-primary">The preffered time for the teacher is {{$course->teacher->preffered_time}}</p>
                            <p class="text-primary">The most preffered time for the students is {{$most_preffered}}</p>
                        </div>

                        {{-- Time  --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">

                                <label for="time">Time</label>
                                <select class="form-group form-select" name="time" id="time"
                                    value="{{ $course->time }}">
                                    <option value="Morning 3:00-4:30">Morning 3:00-4:30</option>
                                    <option value="Afternoon 8:00-9:30">Afternoon 8:00-9:30</option>
                                </select>
                            </div>
                            @error('time')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-2">
                            <h6 class="mt-3 mb-2 text-primary">Teacher Details</h6>
                        </div>



                        {{-- teacher name --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="Teacher">Choose your teacher</label>
                                <select class="form-group form-select" name="teacher_id" id="Teacher"
                                    value="{{ $course->teacher->name }}">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('teacher_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

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
        </form>
    </div>
</div>
