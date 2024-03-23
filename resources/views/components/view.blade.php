@props(['title', 'columns', 'choosen'])


<div class="container my-4">
    <div class="row gutters ">

        {{-- account of the user --}}
        <h2>{{ $title }} Details</h2>
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">
                            Labels
                        </th>
                        <th scope="col">
                            Values
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($columns as $column)
                        <tr>
                            <td>
                                {{ $column }}
                            </td>
                            <td>
                                {{ $choosen->$column }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="/{{ strtolower($title) . '/' . $choosen->id . '/delete' }}" method="POST" class="mx-4">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalCenter">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ModalLongTitle">Are you sure?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Be aware, all the related files with {{$choosen->name }} will be deleted
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </form>
        </div>
    </div>
</div>
