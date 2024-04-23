<html>
<head>
    <title>IIAU-@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
@include('layout.header')

<div style="
    /*background-image: url('storage/Untitled10_20240103115745.png');*/
  background-size: 80vh;
  background-position: right top;
  background-repeat: no-repeat;
  position: relative;
  background-attachment: fixed;
  min-height: 100vh;
 "
     class="mat-typography">

    <div class="main-body">
        <div class="container-sm">
            @include('layout.flash-message')
        </div>

        @yield('content')
    </div>
</div>


@include('layout.footer')

@stack('js')
</body>
</html>
