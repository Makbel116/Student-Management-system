@props(['title', 'columns', 'choosen', 'batches', 'students', 'teachers', 'courses'])
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
                        <h2>Related Batches</h2>
                        <div class="table-responsive">

                            <table class="table table-striped ">
                                <tbody>
                                    @foreach ($batches as $batch)
                                        <tr>
                                            <td>
                                                <a href="/batch/{{ $batch->id }}/view">{{ $batch->name }}</a>
                                            </td>
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

                    @endif
                </div>
            </div>



            {{-- to show the buttons to edit and delete --}}
            <form action="/{{ strtolower($title) . '/' . $choosen->id . '/delete' }}" method="POST">
                @csrf
                @method('delete')
                <a href="/{{ strtolower($title) }}/{{ $choosen->id }}/edit" role="button"
                    class="btn btn-warning mx-4"><i class="fa fa-pencil"></i>
                    Edit</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalCenter">
                    <i class="fa fa-trash"></i> Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="ModalCenterTitle" aria-hidden="true">
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
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                    Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
