<x-layout>
    @include('partials._back')

    <div class="container">
        <div class="row-fluid user-row">


            <strong>Role</strong><br>
            <span class="text-muted">Role Details</span>


        </div>
        <div class="row-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Role information</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">

                        <div class="span6">
                            <table class="table table-condensed table-responsive table-user-information">
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr class="row">
                                            <td class="col-3 align-self-center border-bottom-0 text-center">
                                                {{ $role->name }}</td>
                                            <td class="col-9  border-bottom-0 row">
                                                <table class="table  p-0 col-11 " style="width: 91.66666667%">
                                                    <tr class="row">
                                                        <td class="row py-2">
                                                            <span class="col-4">Role:</span> <span
                                                                class=" col-8 text-success">{{ $role->name }}</span>
                                                        </td>
                                                        <td class="row py-2">
                                                            <span class="col-4">Associated User Number:</span>

                                                            <span
                                                                class="text-success col-8">{{ $role->users->count() }}</span>
                                                        <td class=" py-2 border-bottom-0">
                                                            <span class="col-12">Associated Permissions:</span>
                                                            <span class="col-12 row">
                                                                @foreach ($role->permissions->pluck('name') as $role_permit)
                                                                    <span
                                                                        class="text-success col-lg-3 col-sm-6 my-1">{{ $role_permit }}
                                                                    </span>
                                                                @endforeach
                                                            </span>
                                                        </td>


                                                    </tr>
                                                </table>
                                                <span
                                                    class="col-1 d-flex justify-content-between align-items-end flex-column">
                                                    @if (Auth::user()->can('update roles'))

                                                        <a class="align-self-start px-3"
                                                            title="edit {{ $role->name }}"
                                                            href="/role/{{ $role->id }}/edit"> <span
                                                                class="mr-auto fas fa-gear"></span> </a>
                                                    @endif
                                                    @if (Auth::user()->can('delete roles'))
                                                    <form action="/role/{{ $role->id }}/delete" method="POST"
                                                        class=" align-self-end">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-danger"
                                                            title="delete {{ $role->name }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                        
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->can('create roles'))

                    <div class="panel-footer">
                        <button class="btn  btn-primary " data-bs-toggle="modal" data-bs-target="#addModalCenter"
                            type="button"><i class="icon-envelope icon-white">+ Add a
                                role</i></button>
                    </div>
                @endif
            </div>
        </div>
    </div>


</x-layout>
<div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a New Role</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/role/store" method="POST" class="form-group">
                @csrf
                <div class="modal-body">
                    <div class="col-9">
                        <label for="add">Name</label>
                        <input type="text" name="name" id="add" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <p class="text-success">assign permissions</p>
                        @foreach ($permissions as $permission)
                            <label for="{{ $permission->id }}" class="btn btn-warning my-1">{{ $permission->name }}
                                <input type="checkbox" name="assigned_permissions[]" value="{{ $permission->id }}"
                                    id="{{ $permission->id }}" class="badgebox"><span
                                    class="badge">&check;</span></label>
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
