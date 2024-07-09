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
    <section class="register">
        <h1 class="heading">New here? Join our community by registering now!</h1>
        <div class="row">
            <div class="image">
                <img src="{{asset('assets/img/register.svg')}}" alt="register">
            </div>
            <form action="{{route('register')}}" method="POST">
                @csrf
                <h3>Register</h3>
                <input type="text"  name="lastname" id="lastname" value="{{old('lastname')}}" placeholder="Last Name" class="box">
                @error('lastname')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" placeholder="First Name" class="box">
                @error('firstname')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <input type="text" name="birthdate" id="birthdate" class="box" placeholder="Birthdate" onfocus="(this.type = 'date')" value="{{old('birthdate')}}">
                @error('birthdate')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <div class="radio-group">
                    <input type="radio" id="male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <label for="red">Male</label>
                    <input type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <label for="blue">Female</label>
                </div>
                @error('gender')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <input type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}" class="box">
                @error('email')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <input type="password"  name="password" id="password" placeholder="Password" class="box">
                @error('password')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <input type="password"  name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="box">
                @error('password_confirmation')
                    <p class="erno">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn">Register</button>
                <div class="login">
                    <a href="{{route('login')}}">Already have an account?</a>
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
