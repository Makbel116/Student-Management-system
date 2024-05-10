<x-layout>
    <!-- to add to roles -->

    {{-- to fetch only those studets are ot assigned to --}}

    @php
        // fetch all permissions
        $all_permits = Spatie\Permission\Models\Permission::all();

        // Fetch assigned_permissions if the user wants to remove them
        $assigned_permits = $role->permissions;

        $not_assigned_permits = [];

        // Check if a permission is not assigned and not duplicated each time it is checked
        foreach ($all_permits as $permit) {
            $isAssigned = false;

            foreach ($assigned_permits as $assigned_permit) {
                if ($permit->id === $assigned_permit->id) {
                    $isAssigned = true;
                    break;
                }
            }

            if (!$isAssigned && !in_array($permit, $not_assigned_permits)) {
                // Put not assigned permissions if the user wants to assign them to a role
                array_push($not_assigned_permits, $permit);
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
            <form class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mb-0" action="/role/{{ $role->id }}/update"
                method="POST">
                @csrf
                @method('PUT')


                {{-- Role Details --}}
                <div class="card h-100">
                    <div class="card-body">
                        <h3>Update a Role status</h3>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Role Details</h6>
                            </div>


                            {{-- Role Name --}}
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 my-2">
                                <div class="form-group">
                                    <label for="Name">Role Name</label>
                                    <input type="text" class="form-control" id="Name" name="name"
                                        value="{{ $role->name }}" placeholder="Eg. Admin">
                                </div>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12 my-4">
                                <div class="form-group">
                                    <label class="text-success my-2 col-12">assign to other permissions</label>
                                    @foreach ($not_assigned_permits as $permission)
                                        <label for="{{ $permission->id }}"
                                            class="btn btn-warning col-lg-3 col-sm-4 my-1">{{ $permission->name }}
                                            <input type="checkbox" name="not_assigned_permissions[]"
                                                value="{{ $permission->id }}" id="{{ $permission->id }}"
                                                class="badgebox"><span class="badge">&check;</span></label>
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-12 my-4">
                                <div class="form-group">
                                    <label class="text-danger my-2 col-12">remove from assigned permissions</label>
                                    @foreach ($assigned_permits as $permission)
                                        <label for="{{ $permission->id }}"
                                            class="btn btn-danger col-lg-3 col-sm-4 my-1">{{ $permission->name }}
                                            <input type="checkbox" name="assigned_permissions[]"
                                                value="{{ $permission->id }}" id="{{ $permission->id }}"
                                                class="badgebox"><span class="badge">&check;</span></label>
                                    @endforeach
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
            </form>
        </div>
    </div>
</x-layout>
