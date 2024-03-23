@props(['title', 'columns', 'choosen'])


<div class="container my-4">
    <div class="row gutters ">

        {{-- account of the user --}}
        <h2>{{ $title }} Details</h2>
        <div class="table-responsive"  >

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

        </div>
    </div>
</div>
