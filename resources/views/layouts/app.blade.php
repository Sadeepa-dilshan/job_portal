<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar bg-dark navbar-expand-lg border-body" data-bs-theme="dark">
        <div class="container">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link active" aria-current="page" href="#">Home</a>

              @if(!Auth::check())
              <a class="nav-link" href="{{route('login')}}">Login</a>
              <a class="nav-link" href="{{route('create.seeker')}}">Job Seeker</a>
              <a class="nav-link" href="{{route('create.employer')}}">Employer</a>
             @endif

             @if(Auth::check())
             <a class="nav-link" id="logout" href="#">Logout</a>
              @endif

              <form id="form-logout" action="{{route('logout')}}" method="post">@csrf</form>

            </div>
          </div>
        </div>
      </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    @yield('content')

    <script>
      let logout = document.getElementById('logout');
      let form = document.getElementById('form-logout');
      logout.addEventListener('click', function(){
        form.submit();
      })
    </script>

</body>
</html>