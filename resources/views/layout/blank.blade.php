<html>
    <head>
        <title>IIAU-@yield('title')</title>
        <style>
            div {
                width: 100%;
            }
            table, th, td {
                border: 1px solid;
            }
            table {
                border-collapse: collapse;
            }
            td.sl{
                text-align: right;
            }
            td.number{
                text-align: center;
            }
            td.text{
                text-align: justify;
            }
        </style>
    </head>
    <body>
    @yield('content')
    </body>
</html>
