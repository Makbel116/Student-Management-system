@props(['title', 'choosen'])

<br><br>
<div class="container">
    <div class="row-fluid user-row">


        <strong>{{ $title }}</strong><br>
        <span class="text-muted">{{ $title }} Details</span>

        <div class="span1 dropdown-user" data-bs-for=".cyruxx">
            <i class="icon-chevron-down text-muted"></i>
        </div>
    </div>
    <div class="row-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $title }} information</h3>
            </div>
            <div class="panel-body">
                <div class="row-fluid">


                    <table class="table table-condensed table-responsive table-user-information">
                        <tbody>
                            @foreach ($choosen as $choosen)
                                <tr>
                                    <td>{{ $choosen->id }}</td>
                                    <td>{{ $choosen->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="panel-footer">
                <a  role="button" class="btn  btn-warning " href="/{{ strtolower($title)}}/edit"><i>Edit
                        {{ $title }}</i></a>
            </div>
        </div>
    </div>
</div>
