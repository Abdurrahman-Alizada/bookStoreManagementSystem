<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BSM - System</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />

        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet">
    </head>
    <body id="page-top">
 
  <div class="wrapper" id="welcome">  
    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container justify-content-center">
                <a class="navbar-brand text-warning">Book Store Managment System</a>
                
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bolder">Your Favorite Source of Free Bootstrap Themes</h1>
                        <hr class="divider my-3" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
 
                       <p class="text-white-75 font-weight-light mb-5">Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p>
                       @if (Route::has('login'))
                    @auth
                        <a class="btn btn-warning  btn-sm" href="{{ url('/home') }}">Home</a>
                    @else
                    
                    @if (Route::has('register'))
                    <a class="btn btn-warning  btn-sm" href="{{ route('register') }}">Register</a>
                    @endif

                    <a href="{{ route('login') }}" class="btn btn-primary  btn-sm">Login</a>
                    @endauth
                </div>
            @endif

            
                    </div>
                </div>
            </div>
        </header>
    </div>


    </body>
</html>
