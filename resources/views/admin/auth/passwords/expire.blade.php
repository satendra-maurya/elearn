<!doctype html>
<html>
    <head>
        <title>Reset Password Link expire</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
        <style>
           html, body {
                height: 100%;
            }
            body {
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
                background-size: cover;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
            }
            .wrapper {
                width: 100%;
                display: table;
                height: 100%;
            }
            .page-inner {
                display: table-cell;
                vertical-align: middle;
            }
            .logo {
                width: 100%;
                text-align: center;
                margin-top: 30px;
            }
            .content {
                width: 100%;
                padding: 0 20px;
                text-align: center;
                margin-top: 50px;
            }
            .content p {
                font-size: 24px;
                font-weight: bold;
                color: #ad3644;
                line-height: 40px;
            }
            .logo {
                top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="page-inner">
                <div class="logo">
                    <img src="{{asset('images/logo-full.png')}}" alt="logo">
                </div>
                <div class="content">
                    <div>
                        <p>{{{trans('passwords.token')}}}</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>