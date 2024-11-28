<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.style')
    <title>{{ $title }}</title>
</head>
<body>
    @include('components.navbar')
    <div class="container">
        @yield('content')
    </div>
    @include('components.nav-bottom')
    @include('components.footer')
    @include('components.script')
</body>
</html>