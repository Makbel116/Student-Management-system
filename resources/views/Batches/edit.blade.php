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


        {{-- form to register the  batch --}}
        <form class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mb-0" action="/batch/{{$batch->id}}/update" method="POST">
            @csrf
            @method('PUT')

            {{-- batch Details --}}
            <div class="card h-100">
                <div class="card-body">
                    <h3>Update the batch</h3>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Batch Details</h6>
                        </div>


                        {{-- Batch Name --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="Name">Batch Name</label>
                                <input type="text" class="form-control" id="Name" name="name"
                                    value="{{ $batch->name }}" placeholder="Eg. Batch 04">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>





                        {{-- Start date --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="s_date">Start Date</label>
                                <input type="date" class="form-control" id="s_date" name="start_date"
                                    value="{{ $batch->start_date }}">
                            </div>
                            @error('start_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>



                        {{-- Ending date --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="E_date">End Date</label>
                                <input type="date" class="form-control" id="E_date" name="end_date"
                                    value="{{ $batch->end_date }}">
                                @error('end_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>

                        {{-- phase --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="phase">Batch Phase</label>
                                <select class="form-group form-select" name="phase" id="phase"
                                    value="{{ $batch->phase }}">
                                    <option value="Registeration">Registeration</option>
                                    <option value="Learning">Learning</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            @error('phase')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-2">
                            <h6 class="mt-3 mb-2 text-primary">Course Details</h6>
                        </div>



                        {{-- course name --}}
                     
                        <div class=" container row  my-2">
                            <div class=" text-center gutters">
                                <div class="form-group w-100">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-2">
                                        <h6 class="mt-3 mb-2 text-primary">Choose your course</h6>
                                    </div>
                                    @foreach ($courses as $course)
                                        <label for="{{ $course->id }}" class="btn btn-success my-1">{{ $course->name }}
                                            <input type="radio" name="course_id"
                                                value="{{ $course->id }}" id="{{ $course->id }}"
                                                class="badgebox"><span class="badge">&check;</span></label>
                                    @endforeach
                                    @error('course_id')
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
                                        <select class="form-group form-select" name="teacher_id" id="Teacher">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('teacher_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Batch Details</h6>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-info">The most preffered time for the previous teacher is
                                        {{ $batch->teacher->preffered_time }}</h6>
                                    <h6 class="mb-2 text-info">The most preffered time for the batch is
                                        {{ $most_preffered }}</h6>
                                </div>


                                {{-- Place  --}}
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                    <div class="form-group">
                                        <label for="place">Place</label>
                                        <select class="form-group form-select" name="place_id" id="place">
                                        @foreach ($places as $place)
                                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('place_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>


                                {{-- Time  --}}

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                    <div class="form-group">

                                        <label for="time">Schedule</label>
                                        <select class="form-group form-select" name="schedule_id" id="time">
                                            @foreach ($schedules as $schedule)
                                                <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('schedule_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


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
                </div>
        </form>
    </div>
</div>
</x-layout>