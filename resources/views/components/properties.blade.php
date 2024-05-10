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
            <div class="panel-heading row py-3 m-0">
                <h3 class="col-11 panel-title">{{ $title }} List</h3>
                <div class="col-1 d-flex  " title="edit {{ strtolower($title) }}">
                    @php
                        if ($title == 'Role'||$title== 'User') {
                            $url = '/'.strtolower($title);
                        } else {
                            $url = '/' . strtolower($title) . '/edit';
                        }
                    @endphp
                    <a class="text-white" href="{{ $url }}"><span class="mr-auto fas fa-gear"></span></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row-fluid">


                    <table class="table table-condensed table-responsive table-user-information">
                        <tbody>
                            @foreach ($choosen as $choosen)
                                <tr>
                                    <td>{{ $choosen->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="panel-footer p-4">

            </div>
        </div>
    </div>
</div>
