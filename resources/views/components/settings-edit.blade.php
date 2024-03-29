@props(['title', 'choosen'])

@include('partials._back')

<div class="container">
    <div class="row-fluid user-row">


        <strong>{{ $title }}</strong><br>
        <span class="text-muted">{{ $title }} Details</span>

       
    </div>
    <div class="row-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $title }} information</h3>
            </div>
            <div class="panel-body">
                <div class="row-fluid">

                    <div class="span6">
                        <table class="table table-condensed table-responsive table-user-information">
                            <tbody>
                                @foreach ($choosen as $choosen)
                                    <tr>
                                        <td class="col-3">{{ $choosen->id }}</td>
                                        <td class="col-7"> {{ $choosen->name }}</td>
                                        <form action="/{{ strtolower($title) . '/' . $choosen->id . '/delete' }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <td><button type="submit" class="btn btn-danger" data-bs-bs-toggle="modal"
                                                    data-bs-bs-target="#ModalCenter">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button> </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn  btn-primary " data-bs-toggle="modal" data-bs-target="#addModalCenter"
                    type="button"><i class="icon-envelope icon-white">+ Add a
                        {{$title}}</i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a New {{ $title }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/{{ strtolower($title) }}/store" method="POST" class="form-group">
                @csrf
                <div class="modal-body">
                    <label for="add">Name</label>
                    <input type="text" name="name" id="add"
                        class="form-control">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add {{ $title }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
