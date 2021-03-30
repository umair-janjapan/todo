<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{$title}}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{url('public/css/jquery-ui.css')}}">

  @yield('page-style')
  
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{url('/')}}">{{$app}}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
        <ul class="navbar-nav mt-2 mt-lg-0">
          @if(has_logged_in())
          <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}">Logout</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{url('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('register')}}">Register</a>
          </li>
          @endif

          <!-- <li class="nav-item active mr-auto">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li> -->
        </ul>
      </div>
    </nav>
    <div class="jumbotron text-center">
      <h1>My First Bootstrap Page</h1>
      <p>Resize this responsive page to see the effect!</p> 
    </div>
  
  <div class="container">
      @yield('main-content')
  </div>

  <div class="message"></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    
    var base_url = '{{url("/")}}/';
  </script>

  <script src="{{url('public/js/jquery-ui.min.js')}}"></script>
  <script src="{{url('public/js/custom.js')}}"></script>



  @yield('page-script')

</body>
</html>
