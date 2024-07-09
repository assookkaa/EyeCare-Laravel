<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
        <title>EyeCare</title>
    </head>
    <body>
        <section class="login">
            <h1 class="heading">Welcome! Log in to access your account and explore our site.</h1>
            <div class="row">
                <div class="image">
                    <img src="{{asset('assets/img/login.svg')}}" alt="login">
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h3>Login</h3>
                    <input type="email" placeholder="Email" class="box" name="email" id="email">
                    @error('email')
                        <p class="erno">{{ $message }}</p>
                    @enderror
                    <input type="password" placeholder="Password" class="box" name="password" id="password">
                    @error('password')
                        <p class="erno">{{ $message }}</p>
                    @enderror
                    @if(session('message'))
                        <div class="erno">
                            {{ session('message') }}
                        </div>
                    @endif
                    <button type="submit" class="btn">Login</button>
                    <div class="register">
                        <a href="{{ route('register') }}">Create New Account</a>
                    </div>
                </form>
            </div>
        </section>
        <section class="footer">
            <div class="credit">
                created by <span>EyeCare</span> | all rights reserved.
            </div>
        </section>
    </body>
</html>