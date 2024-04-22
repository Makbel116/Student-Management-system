@props(['title', 'columns', 'choosen', 'batches', 'students', 'teachers', 'courses', 'schedules'])
@include('partials._back')


<div class="container my-4">
    <div class="row gutters ">

        {{-- to show the whole table with the given details --}}
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


            <div class="container my-4">
                <div class="row gutters ">

                    @if ($title !== 'Batch')
                        {{-- to show the whole table with the given details of batch --}}
                        <h2 class="float-left w-75 d-inline">Related Batches</h2>

                        {{-- to add a student to a batch --}}
                        @if ($title == 'Student')
                            <div class="d-flex justify-content-end w-25 float-right">

                                <button type="button"
                                    class=" btn btn-success bg-transparent text-success border-0 p-0 m-0"
                                    data-bs-toggle="modal" data-bs-target="#ModalAdd">
                                    <i class="fa fa-plus"></i> assign to a new batch
                                </button>
                            </div>
                        @endif
                        <div class="table-responsive">

                            <table class="table table-striped ">
                                <tbody>
                                    @foreach ($batches as $batch)
                                        <tr>
                                            <td>
                                                <a href="/batch/{{ $batch->id }}/view">{{ $batch->name }}</a>
                                            </td>

                                            {{-- to delete or dropout a student from a batch --}}
                                            @if ($title == 'Student')
                                                <td>
                                                    <form class="d-flex justify-content-end"
                                                        action="/student/{{ $choosen->id }}/{{ $batch->id }}/dropout"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class=" border-0 bg-transparent text-warning">add
                                                            to dropout</button>

                                                    </form>
                                                </td>
                                                <td>
                                                    <form class="d-flex justify-content-end"
                                                        action="/student/{{ $choosen->id }}/{{ $batch->id }}/remove"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class=" border-0  bg-transparent text-danger">remove
                                                            from batch</button>

                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @else
                        {{-- to show the tables related with  of the batch --}}
                        <h2 class="my-4">Related Tables</h2>
                        <h4 class="my-4">Related Students</h4>
                        <div class="table-responsive">

                            <table class="table table-striped ">
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <a href="/student/{{ $student->id }}/view">{{ $student->name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h4 class="mt-4">Related Courses</h4>
                        <div class="table-responsive">

                            <table class="table table-striped ">
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>
                                                <a href="/course/{{ $course->id }}/view">{{ $course->name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="mt-4">Related Teachers</h4>
                            <div class="table-responsive">

                                <table class="table table-striped ">
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="/teacher/{{ $teacher->id }}/view">{{ $teacher->name }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h4 class="mt-4">Related schedule</h4>
                                <div class="table-responsive">

                                    <table class="table table-striped ">
                                        <tbody>
                                            @foreach ($schedules as $schedule)
                                                <tr>
                                                    <td>

                                                        {{ $schedule->name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($choosen->phase === 'Completed' && count($choosen->students) !== 0)
                            <div>
                                <button type="button"  data-bs-toggle="modal"
                                data-bs-target="#ModalCertificate" class=" border-0  bg-transparent text-primary"><i
                                        class="fas fa-certificate "></i> Generate a Certificate</button>
                                {{-- <form action="/generate-pdf/{{ $choosen->id }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class=" border-0  d-flex align-items-center  w-100 bg-white text-primary gap-2"><i
                                            class="fas fa-certificate "></i> Generate a Certificate</button>
                                </form> --}}
                            </div>
                        @endif
                    @endif
                </div>
            </div>



            {{-- to show the buttons to edit and delete --}}

            <a href="/{{ strtolower($title) }}/{{ $choosen->id }}/edit" role="button"
                class="btn btn-warning mx-4"><i class="fa fa-pencil"></i>
                Edit</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete">
                <i class="fa fa-trash"></i> Delete
            </button>

        </div>
    </div>
</div>





<!-- Modal for delete-->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLongTitle">Are you sure?</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Be aware, all the related files with {{ $choosen->name }} will be deleted
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/{{ strtolower($title) . '/' . $choosen->id . '/delete' }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                        Delete</button>
                </form>

            </div>
        </div>
    </div>
</div>




<!-- to add to batches -->
@if ($title == 'Student')
    {{-- to fetch only those studets are ot assigned to --}}

    @php
        // fetch all batches
        $all_batches = App\models\Batch::all();

        //fetch assigned_batches if the user wants to remove them
        $assigned_batches = $choosen->batches()->get();

        $not_assigned_batches = [];

        //checks if a batch is not assigned and not duplicated each time it is checked
        foreach ($all_batches as $batch) {
            $isAssigned = false;

            foreach ($assigned_batches as $assigned_batch) {
                if ($batch->id === $assigned_batch->id) {
                    $isAssigned = true;
                    break;
                }
            }

            if (!$isAssigned && !in_array($batch, $not_assigned_batches )&& $batch->phase!=='Completed') {
                //puts not assigned batches if the user wants to assign them to  student
                array_push($not_assigned_batches, $batch);
            }
        }
    @endphp
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Add to a new Batch</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/student/{{ $choosen->id }}/assign" method="post">
                    <div class="modal-body">
                        @csrf
                        <label for="all_batches">select a batch</label>
                        <select class="form-group form-select" name="batch" id="all_batches">
                            @foreach ($not_assigned_batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

<div class="modal fade" id="ModalCertificate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLongTitle">Generate a Certificate</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to generate a certificate for all the students in the batch?
            </div>
            <form action="/generate-pdf/{{ $choosen->id }}" method="POST" class="modal-footer">
                <div class="col-9">
                    <input type="checkbox" id="email" name="email" >
                    <label for="email">Send a completion e-mail</label><br>
                </div>
                    @csrf
                    <button type="submit" class="btn btn-success">generate</button>
                </form>

        </div>
    </div>
</div>
