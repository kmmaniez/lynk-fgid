<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap5/css/bootstrap.min.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="{{ asset('assets/feather-icons/dist/feather.js') }}"></script>
    <style>
        .wrapper{
            width: 100vw;
            height: 100vh;
        }

        .bg-glass{
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        section#login-page{
            width: 100%;
            height: inherit;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .banner-image{
            width: 100%;
            height: max-content;
            position: absolute;
        }
        .login-area, .register-area{
            width: 40%;
            height: 100%;
            flex-grow: 1;
        }
        .card{
            height: 100vh;
            transition: transform 500ms ease-in-out;
            border: none;
        }
        .login-area .card{
            border-radius: 0;
        }
        .login-area .card.hidden{
            transform: translateY(-100%);
        }
        .register-area .card.active{
            transform: translateY(-100%);
        }
        img{
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }
        .caption{
            width: 60%;
            padding: 0.5rem 1rem;
            height: max-content;
            bottom: 0;
            left: 0;
        }
        .button-group{
            text-align: end;
        }
        @media (max-width: 820px) {
            .banner-image{
                display: none;
            }
            .login-area, .register-area{
                width: 100vw;
                height: 100%;
                flex-grow: 1;
            }
            .button-group{
                text-align: center;
            }
        }
    </style>
  </head>
  <body>
    
    <div class="wrapper">

        <section id="login-page" class="">

            <div class="banner-image">
                <img src="{{ asset('assets/carousel-1.jpg') }}" alt="" srcset="">
                <div class="caption position-absolute bg-glass text-center text-uppercase text-white">
                    <span class="fw-semibold">Copyright FGID {{ date('Y') }}</span>
                </div> 
            </div>

            <div class="login-area">
                <div class="card">
                    <div class="card-body d-flex flex-column gap-3 justify-content-center align-items-center">
                        @if (session()->has('success'))
                        <div class="alert alert-success w-100">{{ session()->get('success') }}</div>
                        @endif
                        <h2 class="text-uppercase fw-semibold">Login Creator</h2>
                        <form action="{{ route('login') }}" class="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email-login-error') is-invalid @enderror mt-1 rounded-0 form-sm shadow-none" name="email" id="email" value="{{ old('email') }}" required>
                                @error('email-login-error')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control mt-1 rounded-0 form-sm shadow-none" name="password" id="password" required>
                            </div>
                            <div class="button-group">
                                <button class="btn btn-login btn-md shadow-none btn-danger w-100 text-uppercase fw-semibold rounded-0 mt-3 mb-1" style="letter-spacing: 0.5px">Login</button>
                                <small><a href="{{ route('register') }}" id="btnRegister" class="text-decoration-none text-danger">Don't have an account? register</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="register-area">
                <div class="card">
                    <div class="card-body d-flex flex-column gap-3 justify-content-center align-items-center">
                        <h2 class="text-uppercase fw-semibold">Register Creator</h2>
                        <form action="{{ route('register') }}" class="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control mt-1 rounded-0 form-sm shadow-none" name="email" id="email" value="{{ old('email') }}" required>
                                @error('email-register-error')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="username">Username</label>
                                <input type="text" class="form-control mt-1 @error('username') is-invalid @enderror rounded-0 form-sm shadow-none" name="username" id="username" value="{{ old('username') }}" required>
                                @error('username')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="name_register">Full Name</label>
                                <input type="text" class="form-control mt-1 @error('name_register') is-invalid @enderror rounded-0 form-sm shadow-none" name="name_register" id="name_register" value="{{ old('name_register') }}" required>
                                @error('name_register')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="password">Password</label>
                                <input type="password" class="form-control mt-1 rounded-0 form-sm shadow-none" name="password" id="password" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control mt-1 rounded-0 form-sm shadow-none" name="password_confirmation" id="password_confirmation" required>
                                @error('password_register')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="button-group">
                                <button class="btn btn-md btn-register shadow-none btn-danger w-100 text-uppercase fw-semibold rounded-0 mt-3 mb-1" style="letter-spacing: 0.5px">Register</button>
                                <small><a href="#" id="btnLogin" class="text-decoration-none text-danger">Already have an account? login</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <script>
        feather.replace();
    </script>
    <script src="{{ asset('assets/vendor/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script>
        $(document).ready(function() {
            const inputUsername = document.getElementById('username');

            if (localStorage.length > 0) {
                $('.register-area .card').addClass('active');
                $('.login-area .card').addClass('hidden');
                inputUsername.value = localStorage.getItem('username').split('').splice(13).join('')
            }
            $('.btn-register').on('click', () => {
                localStorage.clear()
            })

            $('#btnRegister').on('click',(e)=>{
                e.preventDefault();
                $('.register-area .card').addClass('active');
                $('.login-area .card').addClass('hidden');
            })
            $('#btnLogin').on('click',(e)=>{
                e.preventDefault();
                $('.register-area .card').removeClass('active');
                $('.login-area .card').removeClass('hidden');
            })
            
            $('#btnRegister').on('click', (e) => {
                e.preventDefault()
                if ($('.login-area > .card > .card-body > form').find('input').hasClass('is-invalid')) {
                    $('input').removeClass('is-invalid');
                    $('.login-area >* .form-group > small').remove();
                    $('#email').val('');
                }
            })
            $('body >* .alert').css({
                'transform':'translateX(800px)',
                'transition':'transform 2s 500ms ease-out',
            });
            setTimeout(() => {
                $('body >* .alert').remove();
            }, 5000);
        })
    </script>
  </body>
</html>