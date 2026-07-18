<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | E-Shopper</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/prettyPhoto.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/price-range.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
</head>
<body>

    @include('frontend.layout.header')

    @include('frontend.layout.slider')

        <section>
            <div class="container">
                <div class="row">

                    @include('frontend.layout.menu-left')

                    <div class="col-sm-9 padding-right">
                        @yield('content')
                    </div>

                </div>
            </div>
        </section>

    @include('frontend.layout.footer')

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/contact.js') }}"></script>
    <script src="{{ asset('frontend/js/gmaps.js') }}"></script>
    <script src="{{ asset('frontend/js/html5shiv.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/price-range.js') }}"></script>

</body>
</html>