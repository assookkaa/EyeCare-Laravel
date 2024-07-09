<div class="header">
    <div class="header-left">
        <a href="{{route('home')}}" class="logo">
        <img src="{{asset('assets/img/logo.jpg')}}" alt="Logo">
        </a>
        <a href="{{route('home')}}" class="logo logo-small">
        <img src="{{asset('assets/img/logo-small.png')}}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn">
    <i class="fe fe-text-align-left"></i>
    </a>
    <a class="mobile_btn" id="mobile_btn">
    <i class="fa fa-bars"></i>
    </a>
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <span class="user-img"><img class="rounded-circle" src="{{asset('assets/img/profiles/avatar-01.png')}}" width="31"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{asset('assets/img/profiles/avatar-01.png')}}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{Auth()->user()->firstname}} {{Auth()->user()->lastname}}</h6>
                        <p class="text-muted mb-0">{{ ucfirst(Auth()->user()->usertype) }}</p>
                    </div>
                </div>
                <a class="dropdown-item" href="#">My Profile</a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</div>