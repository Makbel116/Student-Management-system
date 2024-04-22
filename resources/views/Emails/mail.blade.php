<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<body>
    <h1>{{$messageIntro}}</h1>
    <p>{{$messageBody}}</p>
    @if ($title =="Password Reset")
        @include('partials._reset-password-button')
    @endif
    <p>{{$messageFooter}}</p>

    <p>Sincerely</p>
    <p>Omishitu Joy</p>
</body>

</html>
