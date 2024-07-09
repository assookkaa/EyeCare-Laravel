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
        <header class="header">
            <a href="{{url('/')}}" class="logo"><img src="{{asset('assets/img/logo.jpg')}}" alt="Logo"></a>
            <nav class="navbar">
                <a href="#home">Home</a>
                <a href="#services">Services</a>
                <a href="#aboutus">About Us</a>
                <a href="#doctors">Doctors</a>
                <a href="#reviews">Reviews</a>
                <a href="{{route('login')}}" class="toAuthBTN">Login</a>
                <a href="{{route('register')}}" class="toAuthBTN">Register</a>
            </nav>
            <div id="menu-btn" class="fas fa-bars"></div>
        </header>
        <section id="home" class="home">
            <div class="image">
                <img src="{{asset('assets/img/home.svg')}}" alt="home">
            </div>
            <div class="content">
                <h3>Ensuring the Health and Clarity of your Vision</h3>
                <p>Discover a clearer path to healthy vision! Step into our world of expert care and personalized service. Ready to see better? Let's get started!</p>
                <a href="#services" class="btn">
                        Services
                    <span class="fas fa-chevron-right"></span>
                </a>
            </div>
        </section>
        <section class="icons-container">
            <div class="icons">
                <i class="fa-solid fa-users-medical"></i>
                <h3>{{$patientsCount}}</h3>
                <p>Patients </p>
            </div>
            <div class="icons">
                @php
                    $fullStars = floor($averageRating);
                    $halfStar = ceil($averageRating - $fullStars);
                @endphp

                @for ($i = 0; $i < 5; $i++)
                    @if ($i < $fullStars)
                        <i class="fa-solid fa-star"></i> 
                    @elseif ($i == $fullStars && $halfStar)
                        <i class="fa-solid fa-star-half-alt"></i>
                    @else
                        <i class="fa-regular fa-star"></i> 
                    @endif
                @endfor

                <h3>{{ number_format($averageRating, 1) }}</h3>
                <p>{{ $ratingsCount }} Reviews</p>
            </div>
        </section>
        <section id="services" class="services">
            <h1 class="heading">Our services</h1>
            <div class="box-container">
                <div class="box">
                    <i class="fa-regular fa-eye"></i>
                    <h3>free eye check-ups</h3>
                    <p>Regular eye check-ups are essential for maintaining good vision health. Our free eye check-ups ensure that you can monitor your eye health without any cost.</p>
                </div>
                <div class="box">
                    <i class="fas fa-prescription"></i>
                    <h3>eyeglass prescription</h3>
                    <p>Need a new eyeglass prescription? Our expert optometrists provide accurate prescriptions tailored to your vision needs, ensuring clear and comfortable vision.</p>
                </div>
                <div class="box">
                    <i class="fa-regular fa-glasses-round"></i>
                    <h3>eyeglass free repair</h3>
                    <p>Accidents happen! If your eyeglasses need repairs, don't worry. Our repair service is here to fix them for you at no cost, ensuring you can see clearly again in no time.</p>
                </div>
            </div>
        </section>
        <section id="aboutus" class="about">
            <h1 class="heading">about us</h1>
            <div class="row">
                <div class="image">
                    <img src="{{asset('assets/img/about.svg')}}" alt="home">
                </div>
                <div class="content">
                    <div class="icon-container">
                        <div class="icon">
                            <i class="fa-solid fa-calendar-days fa-2xl"></i>
                        </div>
                        <div class="desc">
                            <h3>Working Days</h3>
                            <p>We are available for appointments from Monday to Saturday, from 8:00 AM to 12:00 PM. Schedule your visit with us during these times.</p>
                        </div>
                    </div>
                    <div class="icon-container">
                        <div class="icon">
                            <i class="fa-solid fa-light-emergency-on"></i>
                        </div>
                        <div class="desc">
                            <h3>Emergency</h3>
                            <p>In case of emergencies, our dedicated team is available to assist you promptly. Reach out to us at any time for urgent eye care needs.</p>
                        </div>
                    </div>
                    <div class="icon-container">
                        <div class="icon">
                            <i class="fa-solid fa-hand-holding-medical"></i>
                        </div>
                        <div class="desc">
                            <h3>Services</h3>
                            <p>Explore our wide range of services tailored to meet your eye care needs. From routine check-ups to specialized treatments, we've got you covered.</p>
                        </div>
                    </div>  
                </div>
            </div>
        </section>
        <section id="doctors" class="doctors">
            <h1 class="heading">Our doctors</h1>
            <div class="box-container">
                <div class="box">
                    <img src="{{asset('assets/img/doc.jpg')}}" alt="home">
                    <h3>Jani jani</h3><span>expert doctor</span>
                    <div class="share">
                        <a href="" class="fab fa-facebook"></a>
                        <a href="" class="fas fa-phone"></a>
                    </div>
                </div>
                <div class="box">
                    <img src="{{asset('assets/img/reg.png')}}" alt="home">
                    <h3>Rehina d 3rd</h3><span>expert doctor</span>
                    <div class="share">
                        <a href="" class="fab fa-facebook"></a>
                        <a href="" class="fas fa-phone"></a>
                    </div>
                </div>
                <div class="box">
                    <img src="{{asset('assets/img/doc.jpg')}}" alt="home">
                    <h3>jani jani</h3><span>expert doctor</span>
                    <div class="share">
                        <a href="" class="fab fa-facebook"></a>
                        <a href="" class="fas fa-phone"></a>
                    </div>
                </div>
            </div>
        </section>
        <section id="reviews" class="reviews"> 
            <h1 class="heading">Reviews</h1>
            <div class="box-container">
                @forelse($reviews as $rating)
                <div class="box">
                    <img src="{{asset('assets/img/profiles/avatar-01.png')}}" alt="">
                    <h3>{{$rating->appointment->user->firstname}} {{$rating->appointment->user->lastname}}</h3>
                    <div class="stars">
                        @for ($i = 0; $i < $rating->rate; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                    <p class="text">{{$rating->feedback}}</p>
                </div>
                @empty
                <div class="box">
                    <img src="{{asset('assets/img/profiles/avatar-01.png')}}" alt="">
                    <h3>EyeCare</h3>
                    <p class="text">No reviews yet.</p>
                </div>
                @endforelse
            </div>
        </section>
        <section class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>Quick links</h3>
                    <a href="#home"><i class="fas fa-chevron-right"></i>Home</a>
                    <a href="#services"><i class="fas fa-chevron-right"></i>services</a>
                    <a href="#aboutus"><i class="fas fa-chevron-right"></i>About us</a>
                    <a href="#doctors"><i class="fas fa-chevron-right"></i>doctors</a>
                    <a href="#reviews"><i class="fas fa-chevron-right"></i>reviews</a>
                </div>
                <div class="box">
                    <h3>Contacts</h3>
                    <a href=""><i class="fas fa-phone"></i>(+63) 123 4567 890</a>
                    <a href=""><i class="fa-solid fa-envelope"></i>rehina@gmail.com</a>
                    <a href=""><i class="fas fa-map-marker-alt"></i>Kilid crispy king sa police station</a>
                </div>
                <div class="box">
                    <h3>Follow us</h3>
                    <a href=""><i class="fab fa-facebook"></i>facebook</a>
                    <a href=""><i class="fab fa-twitter"></i>twitter</a>
                    <a href=""><i class="fab fa-square-instagram"></i>instagram</a>
                </div>
            </div>
            <div class="credit">
                created by <span>EyeCare</span> | all rights reserved.
            </div>
        </section>
        <script>
            let menu = document.querySelector('#menu-btn');
            let navbar = document.querySelector('.navbar');

            menu.onclick = () => {
                menu.classList.toggle('fa-times');
                navbar.classList.toggle('active');
            }
            window.onscroll = () => {
                menu.classList.remove('fa-times');
                navbar.classList.remove('active');  
            }
        </script>
    </body>
</html>