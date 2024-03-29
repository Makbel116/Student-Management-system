@props(['title', 'collection'])

<h2 class="my-4">{{ $title }} List</h2>
<div class="table-responsive small mb-4">
    <table class="table table-striped table-sm">
        <thead>
            <tr>

                {{-- common for all --}}
                <th scope="col">#</th>
                <th scope="col">Name</th>


                {{-- common for students & teachers --}}
                @if ($title == 'Student' || $title == 'Teacher')
                    <th scope="col">Age</th>
                    <th scope="col">gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Location</th>
                    <th scope="col">Status</th>
                    <th scope="col">Phone</th>

                    {{-- students only --}}
                    @if ($title == 'Student')
                        <th scope="col">Belonged Batch</th> 

                        {{-- teachers only --}}
                        {{-- @else
                        <th scope="col">Status</th> --}}
                    @endif


                    {{-- batches only --}}
                @elseif($title == 'Batch')
                    <th scope="col">Place</th>
                    <th scope="col">Time</th>
                    <th scope="col">Start date</th>
                    <th scope="col">End Date</th>

                    
                    {{-- courses only --}}
                @else
                    <th scope="col">Description</th>
                @endif
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collection as $eachRow)
                <tr>
                    <td>{{ $eachRow->id }}</td>
                    <td>{{ $eachRow->name }}</td>



                    {{-- common for students & teachers --}}
                    @if ($title == 'Student' || $title == 'Teacher')
                        <td>{{ $eachRow->age }}</td>
                        <td>{{ $eachRow->gender }}</td>
                        <td>{{ $eachRow->email }}</td>
                        <td>{{ $eachRow->location->name }}</td>
                        <td>{{ $eachRow->status }}</td>
                        <td>{{ $eachRow->phone_number }}</td>


                       {{-- students only --}}
                        @if ($title == 'Student')
                           
                            <td>{{ implode(', ', array_column($eachRow->batches->toArray(), 'name')) }}</td>



                            {{-- teachers only --}}
                            {{-- @else --}}
                        @endif


                        {{-- batches only --}}
                    @elseif($title == 'Batch')
                        <td>{{ $eachRow->place }}</td>
                        <td>{{ $eachRow->schedule->name }}</td>
                        <td>{{ $eachRow->start_date }}</td>
                        <td>{{ $eachRow->end_date }}</td>

                        
                        {{-- courses only --}}
                    @else
                        <td>{{ $eachRow->description }}</td>
                    @endif
                    <td><a href="{{ strtolower($title) . '/' . $eachRow->id . '/view' }}">....</a></td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>
