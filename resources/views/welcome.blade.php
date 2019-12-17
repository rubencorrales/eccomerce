<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Qrriculum</title>

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
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Acceder</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registro</a>
                        @endif
                    @endauth
                </div>
            @endif

                <div class="content">
                    <div class="title m-b-md">
                        Qrriculum
                    </div>
                    <p>Esta plataforma ha sido creada con la intención de ofrecer un servicio de curriculum único donde puedas administrar tus conocimientos, experiencias y demás aptitudes</p>

                    <p>Ofrecemos una API de conexión para que todos los portales de empleo puedan hacer uso de tus datos y presentar tu candidatura en todos ellos sin necesidad de cumplimentar interminables cuestionarios</p>
                    <br>
                    <div class="links">
                        {{--                    <a href="{{ action('Auth\RegisterController@register') }}">Alta Candidato</a>--}}
                        <a href="">Candidatos</a>
                        <a href="">Empresas</a>
                        <a href="">ETT's</a>
                        <a href="">Organismos</a>
                        <a href="">Integradores</a>

                    </div>
                </div>
        </div>
    </body>
</html>
