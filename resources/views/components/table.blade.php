@props(['title', 'collection'])

<h2>{{ $title }} List</h2>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                {{-- common for all --}}
                <th scope="col">#</th>
                <th scope="col">Name</th>
                @if ($title == 'Student' || $title == 'Teacher')
                    {{-- common for students & teachers --}}
                    <th scope="col">Age</th>
                    <th scope="col">gender</th>
                    {{-- students only --}}
                    @if ($title == 'Student')
                    <th scope="col">Course</th>
                    <th scope="col">Teacher</th>
                        {{-- teachers only --}}
                    @else
                        <th scope="col">Status</th>
                        <th scope="col">Phone</th>
                    @endif
                    {{-- courses only --}}
                @else
                    <th scope="col">Place</th>
                    <th scope="col">Teacher</th>
                    <th scope="col">Time</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($collection as $eachRow)
                <tr>
                    <td>{{ $eachRow->id }}</td>
                    <td>{{ $eachRow->name }}</td>
                    @if ($title == 'Student' || $title == 'Teacher')
                        {{-- common for students & teachers --}}
                        <td>{{ $eachRow->age }}</td>
                        <td>{{ $eachRow->gender }}</td>
                        {{-- students only --}}
                        @if ($title == 'Student')
                        <td>{{ $eachRow->course->name }}</td>
                        <td>{{ $eachRow->course->teacher->name }}</td>
                            {{-- teachers only --}}
                        @else
                            <td>{{ $eachRow->status }}</td>
                            <td>{{ $eachRow->phone_number }}</td>
                        @endif
                        {{-- courses only --}}
                    @else
                    <td>{{ $eachRow->place }}</td>
                    <td>{{ $eachRow->teacher->name }}</td>
                        <td>{{ $eachRow->time }}</td>
                    @endif
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
