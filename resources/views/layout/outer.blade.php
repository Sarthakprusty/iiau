<html>
<head>
    <title>IIAU-@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .enlarge-on-hover:hover {
            box-shadow: 2px 2px 0.2px rgba(0, 0, 0, 0.7);
            transform: scale(1.05);
            transition: transform 1s ease, box-shadow 1s ease;
        //background: linear-gradient(to top left, #e3e2e2,white);
        }

        .enlarge-on-hover.clicked  {
            box-shadow: none;
            transform: scale(0.9);
        //transition: transform 0.3s ease, box-shadow 0.3s ease;
        //background: linear-gradient(to top left, #e3e2e2,white);
        }





        body
        {
        //background:url(https://raw.githubusercontent.com/naaficodes/Monkey-Login/master/images/monkeybg.png) #1b8c1b66 ;
            background-size: 5%;
        }
        .maincontainer
        {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100vw;
            height: 100vh;
        }

        .monkeylogin
        {
            width: 350px;
            height: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: white;
        //border-radius: 40px;
        //background-color: transparent;
        }
        //monkeylog{
          //  background-image: url('https://wallpapercave.com/wp/wp6515991.jpg');background-size: cover; background-position: center;background-repeat: no-repeat;width: 650px;height: 500px;box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
          //  display: flex;
          //  align-items: center;
          //  flex-direction: column;
          //}
        .animcon
        {
            background-color: white;

            overflow: hidden;
            /*overflow hidden because to keep the hand image hidden below*/
            margin-top:20px;
            height: 160px;
            width: 160px;
            border-radius: 50%;
            background-image: url('https://wallpapercave.com/wp/wp6515388.jpg');
            background-size: cover;
        //background-size: 90% 85%;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);

            /*flex center to keep the hand image in the center*/
            display: flex;
            align-items: center;
            flex-direction: column;

            position: relative;

            justify-content: center;

        }

        img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: 1s;
        }

        .animcon img
        {
            margin-top:110%;
            height: 170px;
            width: 170px;
            transition: 1s;
        }

        .formcon
        {
            margin-top: 38px;
        }
        input
        {
            height: 40px;
            width: 300px;
            /*background-color: #254E58;*/
            border-radius: 20px;
            border:none;
            color: #5a5449;
            text-indent: 15px;
            font-size: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
            outline: none;
        }
        input::placeholder
        {
            color:lightgrey;
            font-size: 100%;
            font-weight: lighter;
            text-indent: 15px;
        }
        .sbutton
        {
            text-indent: 0px;
            height: 40px;
            width: 300px;
            margin-top: 10px;
            background-color: #1b8c1b66;
            transition: 2s;
            border: none;
            color: white;
            font-weight: bolder;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
            outline: none;
        }

        .sbutton:hover
        {
            color: #5a5449;
            cursor: pointer;
        }

        .foot
        {
            color: #5a5449;
            font-weight: lighter;
            margin-top: 40px;
        }

        @media only screen and (max-width: 1200px) {
            .sideimage {
                display: none;
            }
        }
    </style>
</head>
<body>

<div style="background-image: url('images/Untitled10_20240103115745.png');
  background-size: 80vh;
  background-position: right top;
  background-repeat: no-repeat;
  position: relative;
  background-attachment: fixed;" class="mat-typography">
    <div class="textbox" style="margin-top: 1cm">
       <!-- <strong class="title">Welcome to Samekit.</strong>

        <div class="subtitle" style="margin-top: 1.2cm;">Apply, Request, Collect Everything at One place now.</div>-->
    </div>

    <div class="main-body" style="width: 100%">
        @yield('content')
    </div>
</div>




@stack('js')
</body>
</html>
