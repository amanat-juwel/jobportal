<!DOCTYPE html>
<html lang="en">
<head>
  <title>JobPortal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <meta name="_token" content="{!! csrf_token() !!}" />
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">JobPortal</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
        @guest
        @else
        <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{ url('/profile') }}">Profile</a></li>
        @endif
        <li class=""><a href="{{ url('/admin') }}">Employers</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        @guest
        <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        @else
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          @if(Session::has('success'))
                <div class="alert alert-success" id="success">
                    {{Session::get('success')}}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
            @endif
          </div>
        </div>
      </div>
      @yield('content')
    </div>
</div>

@yield('script')

</body>
</html>
