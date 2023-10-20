<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>

    @stack('style')

    <style>
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
      .social-media{
        width: 200px;
        height: max-content;
      }
      footer ul{
        list-style-type: none;
      }
      .social-media ul{
        padding: 0;
        /* background-color: cyan; */
      }
      .social-media ul li{
        padding: 4px;
        /* background-color: blueviolet; */
      }
      svg.fa-16{
        width: 16px;
        height: 16px;
      }
      svg.fa-24{
        width: 24px;
        height: 24px;
      }
      footer{
        display: flex;
        justify-content: space-evenly;
        align-items: center;
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
        footer{
          text-align: center;
          display: flex;
          flex-direction: column;
          justify-content: space-evenly;
          align-items: center;
          gap: 2rem;
        }
      }
      main{
        overflow: hidden;
      }
      footer{
        background-color: #191d20;
      }
      footer a{
        color: #fff;
      }
      footer a:hover{
        opacity: 0.8;
      }
    </style>
    
  </head>
  <body class="bg-dark">

      <nav class="navbar navbar-expand-lg sticky-top" style="height: 4rem;">
        <div class="container d-flex justify-content-between">
          <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/logo.png') }}" id="logo" alt="Logo" class="d-inline-block align-text-top">
          </a>
          @auth
          <div class="hstack">
            <span class=""><a href="{{ route('public.discover') }}" class="text-white text-decoration-none" id="">Discover</a></span>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button id="btnLogin" class="btn btn-md rounded-pill px-4">Logout</button>
            </form>
          </div>
          @endauth

          @guest
          <div class="hstack">
            <span class=""><a href="{{ route('public.discover') }}" class="text-white text-decoration-none" id="">Discover</a></span>
            <a href="{{ route('login') }}" id="btnLogin" class="btn btn-md rounded-pill">Login</a>
          </div>
          
          @endguest
        </div>
      </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bottom-fixed text-white py-4">

      <div class="description">
        <span>Made with <i data-feather="heart" class="fa-16"></i> from FGID</span>
        <span class="d-block mb-2">PT. FGID Indonesia</span>
        <span class="d-block"><a href="http://" class="text-decoration-none">Syarat dan ketentuan</a></span>
        <span><a href="http://" class="text-decoration-none">FAQ</a></span>
      </div>

      <div class="social-media">
        <ul class="d-flex justify-content-between">
          <li><a href="http://"><i data-feather="instagram" class="fa-24"></i></a></li>
          <li><a href="http://"><i data-feather="facebook" class="fa-24"></i></a></li>
          <li><a href="http://"><i data-feather="twitter" class="fa-24"></i></a></li>
          <li><a href="http://"><i data-feather="mail" class="fa-24"></i></a></li>
        </ul>
      </div>
    </footer>
    
    <script>
        feather.replace();
    </script>
    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    @stack('scripts')
    
  </body>
</html>