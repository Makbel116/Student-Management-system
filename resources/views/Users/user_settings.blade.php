<x-layout>
    @include('partials._back')

    <div class="container">
        <div class="row-fluid user-row">


            <strong>User</strong><br>
            <span class="text-muted">User Details</span>


        </div>
        <div class="row-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">User information</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">

                        <div class="span6">
                            <table class="table table-condensed table-responsive table-user-information">
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="row">
                                            <td class="col-3 align-self-center border-bottom-0 text-center">
                                                {{ $user->name }}</td>
                                            <td class="col-9  border-bottom-0 row">
                                                <table class="table  p-0 col-11 " style="width: 91.66666667%">
                                                    <tr class="row">
                                                        <td class="row py-2">
                                                            <span class="col-4">user:</span> <span
                                                                class=" col-8 text-success">{{ $user->name }}</span>
                                                        </td>
                                                        <td class="row py-2">
                                                            <span class="col-4">Associated Role:</span>
                                                            @php
                                                                $roles = $user->getRoleNames()->toArray();
                                                            @endphp

                                                            <span class="text-success col-8">
                                                                @if (!empty($roles))
                                                                    <p>{{ implode(', ', $roles) }}</p>
                                                                @else
                                                                    <p class="text-danger">null</p>
                                                                @endif
                                                            </span>



                                                    </tr>
                                                </table>
                                                <span
                                                    class="col-1 d-flex justify-content-between align-items-end flex-column">
                                                    @if (Auth::user()->can('update users'))

                                                        <a class="align-self-start px-3"
                                                            title="edit {{ $user->name }}"
                                                            href="/user/{{ $user->id }}/edit"> <span
                                                                class="mr-auto fas fa-gear"></span> </a>
                                                    @endif
                                                    @if (Auth::user()->can('delete users'))

                                                        <form action="/user/{{ $user->id }}/delete" method="POST"
                                                            class=" align-self-end">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="submit" class="btn btn-danger"
                                                                title="delete {{ $user->name }}">
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
                @if (Auth::user()->can('create users'))

                    <div class="panel-footer">
                        <button class="btn  btn-primary " data-bs-toggle="modal" data-bs-target="#addModalCenter"
                            type="button"><i class="icon-envelope icon-white">+ Add a
                                user</i></button>
                    </div>
                @endif
            </div>
        </div>
    </div>


</x-layout>
<div class="modal fade" id="addModalCenter" tabindex="-1" user="dialog" aria-labelledby="addModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" user="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a New user</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/user/store" method="POST" class="form-group">
                @csrf
                <div class="modal-body">
                    <div class="col-9 p-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-9 p-3">
                        <label for="email">email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-9 p-3">
                        <label for="username">User name</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username') }}">
                        @error('username')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row p-3">

                        <div class="col-6">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="password_confirmation">confirm your password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
