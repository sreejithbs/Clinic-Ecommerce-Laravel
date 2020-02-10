<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inner Beauty</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #0076b3;
                padding: 0 25px;
                font-size: 15px;
                font-weight: 600;
                /*letter-spacing: .1rem;*/
                text-decoration: none;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    INNER BEAUTY
                </div>

                <div class="links">
                    @if(\Auth::guard('admin')->check())
                        <a href="{{ route('admin_dashboard') }}"> <strong>View Super Admin Dashboard </strong></a>
                    @elseif(\Auth::guard('clinic')->check())
                        <a href="{{ route('clinic_dashboard') }}"> <strong>View Clinic Admin Dashboard </strong></a>
                    @elseif(\Auth::guard('web')->check())
                        <a href="{{ route('user_dashboard') }}"> <strong>View User Dashboard </strong></a>
                    @else
                        <a href="{{ route('login') }}"> <strong>User Login </strong></a>
                        <a href="{{ route('register') }}"> <strong>User Registration </strong></a>
                        <a href="{{ route('admin_login') }}"> <strong>Admin Login </strong></a>
                        <a href="{{ route('admin_register') }}"> <strong>Admin Registration </strong></a>
                        <a href="{{ route('clinic_login') }}"> <strong>Clinic Login </strong></a>
                        <a href="{{ route('clinic_register') }}"> <strong>Clinic Registration </strong></a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
