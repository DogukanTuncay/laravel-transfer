<!DOCTYPE html>
<html lang="{{$app->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/icon.png')}}">

    @include('layouts.frontend.main-css')

    <title>GOVIP TRANSFER</title>
</head>
<body>
    @include('layouts.frontend.header')

        @yield('content')

    @include('layouts.frontend.footer')

    @include('layouts.frontend.main-js')

</body>
</html>
