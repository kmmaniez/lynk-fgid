<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    @stack('style')

    <style>
      #btnLogin{
        border: 1px solid rgb(232, 32, 32);
        color: #fff;
        font-weight: bold;
      }
      #btnLogin:is(:hover){
        border: 1px solid #fff;
      }
    </style>
    
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-lg bg-dark" style="height: 4rem;">
        <div class="container d-flex justify-content-between">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150" class="d-inline-block align-text-top">
          </a>
          <a href="#" id="btnLogin" class="btn btn-md rounded-pill px-4">Login</a>
        </div>
      </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bottom-fixed">
        <h3>Copyright <?= date('Y'); ?></h3>
    </footer>
    
    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> --}}
  </body>
</html>