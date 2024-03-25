@include('partials._head')
@include('partials._back')

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


        {{-- form to register the course --}}
        <form class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mb-0" action="/course/store" method="POST">
            @csrf


            {{-- Course Details --}}
            <div class="card h-100">
                <div class="card-body">
                    <h3>Start a new Course</h3>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Course Details</h6>
                        </div>


                        {{-- Course Name --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="Name">Course Name</label>
                                <input type="text" class="form-control" id="Name" name="name"
                                    value="{{ old('name') }}" placeholder="Eg. Laravel">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>





                        {{-- Description--}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ old('description') }}">
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>

                    </div>
                </div>




                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-4">
                        <div class="text-right">

                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
