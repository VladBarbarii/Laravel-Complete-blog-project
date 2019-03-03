    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">-->
    <!--    <link rel="stylesheet" href="template/css/index.css">-->
    <title>Blog posts</title>
</head>
<body>
@include('partials.navbar')
@include('partials.errors')
@yield('content')

@include('partials.footer')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>