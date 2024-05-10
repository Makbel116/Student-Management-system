<x-layout>
    <!-- to add to edit -->

    {{-- to fetch only those studets are ot assigned to --}}

    @php
        // fetch all roles
        $all_roles = Spatie\Permission\Models\Role::all();

        // Fetch assigned_roles if the user wants to remove them
        $assigned_roles = $user->roles;

        $not_assigned_roles = [];

        // Check if a role is not assigned and not duplicated each time it is checked
        foreach ($all_roles as $role) {
            $isAssigned = false;

            foreach ($assigned_roles as $assigned_role) {
                if ($role->id === $assigned_role->id) {
                    $isAssigned = true;
                    break;
                }
            }

            if (!$isAssigned && !in_array($role, $not_assigned_roles)) {
                // Put not assigned roles if the user wants to assign them to a user
                array_push($not_assigned_roles, $role);
            }
        }
    @endphp

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


            {{-- form to update the Role --}}
            <form class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mb-0" action="/user/{{ $user->id }}/update"
                method="POST">
                @csrf
                @method('PUT')


                {{-- User Details --}}
                <div class="card h-100">
                    <div class="card-body">
                        <h3>Update a User status</h3>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">User Details</h6>
                            </div>


                            {{-- User Name --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="Name">User Name</label>
                                    <input type="text" class="form-control" id="Name" name="name"
                                        value="{{ $user->name }}" placeholder="Eg. Admin">
                                </div>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email" name="email"
                                        value="{{ $user->email }}" placeholder="Eg. user@gmail.com">
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="username">User username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ $user->username }}" >
                                </div>
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm your password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                                @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </div>

                            @if (Auth::user()->can('assign permissions'))
                                
                            <div class="col-12 my-4">
                                <div class="form-group">
                                    <label class="text-success my-2 col-12">assign to other roles</label>
                                    @foreach ($not_assigned_roles as $role)
                                        <label for="{{ $role->id }}"
                                            class="btn btn-warning col-lg-3 col-sm-4 my-1">{{ $role->name }}
                                            <input type="checkbox" name="not_assigned_roles[]"
                                                value="{{ $role->id }}" id="{{ $role->id }}"
                                                class="badgebox"><span class="badge">&check;</span></label>
                                    @endforeach
                                </div>

                            </div>
                            @endif

                            @if (Auth::user()->can('revoke permissions'))
                                
                            <div class="col-12 my-4">
                                <div class="form-group">
                                    <label class="text-danger my-2 col-12">remove from assigned roles</label>
                                    @foreach ($assigned_roles as $role)
                                        <label for="{{ $role->id }}"
                                            class="btn btn-danger col-lg-3 col-sm-4 my-1">{{ $role->name }}
                                            <input type="checkbox" name="assigned_roles[]"
                                                value="{{ $role->id }}" id="{{ $role->id }}"
                                                class="badgebox"><span class="badge">&check;</span></label>
                                    @endforeach
                                </div>

                            </div>
                            @endif
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
</x-layout>
