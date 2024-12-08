<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.style')
    <title>{{ $title }}</title>
</head>

<body>
    <div class="article-detail">
        @yield('content')
    </div>

    <div class="back-to-top">
        <a class="icon-back-to-top" href="#"><i class='bx bxs-chevron-up fs-2'></i></a>
    </div>

    @include('components.footer')
    @include('components.script')
</body>

</html>
