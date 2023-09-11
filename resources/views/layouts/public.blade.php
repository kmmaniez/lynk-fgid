<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">

    @stack('style')
    
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container d-flex justify-content-between">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="150" height="32" class="d-inline-block align-text-top">
          </a>
          <a href="#" class="btn btn-outline-danger btn-md rounded-pill">Login</a>
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
  </body>
</html>