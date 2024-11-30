<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.style')
    <title>{{ $active }}</title>
</head>

<body>
    @include('components.loading')
    <div class="dark-mode-auth">
        <button class="dark-mode-toggle"><i class='bx bx-sun'></i></button>
    </div>
    <div class="container">
        @include('components.toast')
        @yield('content')
    </div>
    @include('components.script')
    <script src="{{ url('/assets/js/auth.js') }}"></script>
</body>

</html>