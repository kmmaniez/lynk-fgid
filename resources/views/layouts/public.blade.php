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
      body{
        /* background-color: #c71224; */
      }
      .navbar{
        background-color: #191d20;
      }
      #btnLogin{
        border: 1px solid rgb(232, 32, 32);
        color: #fff;
        font-weight: bold;
        padding: 8px 24px;
      }
      #logo{
        width: 150px;
      }
      #btnLogin:is(:hover){
        border: 1px solid #fff;
      }
      .hstack{
        gap: 2rem;
      }
      @media (max-width: 768px) {
        #logo{
          width: 124px;
        }
        .hstack{
          gap: 16px;
        }
        #btnLogin{
          font-size: 14px;
        }
      }
    </style>
    
  </head>
  <body class="bg-dark">

      <nav class="navbar navbar-expand-lg sticky-top" style="height: 4rem;">
        <div class="container d-flex justify-content-between">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/logo.png') }}" id="logo" alt="Logo" class="d-inline-block align-text-top">
          </a>
          @auth
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button id="btnLogin" class="btn btn-md rounded-pill px-4">Logout</button>
            </form>
          @endauth

          @guest
          <div class="hstack">
            <span class=""><a href="{{ route('discover') }}" class="text-white text-decoration-none" id="">Discover</a></span>
            <a href="{{ route('login') }}" id="btnLogin" class="btn btn-md rounded-pill">Login</a>
          </div>
          
          @endguest
        </div>
      </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bottom-fixed text-center">
        <h3>Copyright <?= date('Y'); ?></h3>
    </footer>
    
    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> --}}
  </body>
</html>