<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
        <title>EyeCare</title>
    </head>
    <body>
        <section class="login">
            <h1 class="heading">welcome to EyeCare clinic management system</h1>
            <div class="row">
                <div class="image">
                    <img src="{{asset('assets/img/login.svg')}}" alt="login">
                </div>
                <form action="{{ route('adminlogin') }}" method="POST">
                    @csrf
                    <h3>admin Login</h3>
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