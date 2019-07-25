<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <a class="navbar-brand" href="#">JobListing</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="{{ url('user/profile/{id}') }}">Profile</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @guest
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        @else
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
    <div class="jumbotron text-center">
      <h1>My First Bootstrap Page</h1>
      <p>Resize this responsive page to see the effect!</p> 
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <h3>Latest Posts</h3> 
          <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                 <div class="panel-heading">Panel Heading</div>
                  <div class="panel-body">
                    <p><i class="fa fa-institution"></i> Laravel LLC</p>
                    <p><strong>Description:</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    <p><i class="fa fa-money"></i> Negotiable</p>
                    <p><i class="fa fa-map-marker"></i> Dhaka, Bangladesh</p>
                    <button class="btn btn-default brn-sm pull-right">Apply Now</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>
