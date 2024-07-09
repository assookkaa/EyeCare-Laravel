<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>EyeCare</title>
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    </head>
    <body>
        <div class="main-wrapper">
            @include('layouts.header')
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title">
                            </li>
                            <li>
                                <a href="{{route('home')}}"><i class="fa-regular fa-house fa-2xs"></i> <span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="{{route('appointment')}}"><i class="fa-regular fa-suitcase-medical fa-2xs"></i> <span>Appointment</span></a>
                            </li>
                            <li>
                                <a href="{{route('checkup')}}"><i class="fa-regular fa-hospitals fa-2xs"></i> <span>Check-up</span></a>
                            </li>
                            <li class="active">
                                <a href="{{route('users')}}"><i class="fa-regular fa-hospital-user fa-2xs"></i> <span>User Management</span></a>
                            </li>
                            <li>
                                <a href="{{route('records')}}"><i class="fa-regular fa-notes-medical fa-2xs"></i> <span>Medical Records</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">General Settings</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active">General Settings</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row settings-tab">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header all-center">
                                    <img class=" avatar avatar-sm me-2 avatar-img rounded-circle" src="{{asset('assets/img/profiles/avatar-01.png')}}">
                                    <h6>{{ $user->firstname }} {{ $user->lastname }}</h6>
                                    <p>{{ $user->email }}</p>
                                    <p>{{ $user->custom_id }}</p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="profile-list">
                                        <a href="#">Registered Date</a>
                                        <a href="#" class="float-end">
                                            <h5>{{ \Carbon\Carbon::parse($user->created_at)->format('M j, Y') }}</h5>
                                        </a>
                                    </div>
                                    <div class="profile-list">
                                        <a href="#">Last Login</a>
                                        <a href="#" class="float-end">
                                            <h5>{{ $user->last_login_at }}</h5>
                                        </a>
                                    </div>
                                    <div class="profile-list">
                                        <a href="#">Login Time</a>
                                        <a href="#" class="float-end">
                                            <h5>{{ $user->login_at }}</h5>
                                        </a>
                                    </div>
                                    <div class="profile-list">
                                        <a href="#">Logout Time</a>
                                        <a href="" class="float-end">
                                            <h5>{{ $user->logout_at }}</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-tabs-bottom">
                                        <li class="nav-item"><a class="nav-link active"
                                                href="#profileinfo" data-bs-toggle="tab">Profile Information</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#security"
                                                data-bs-toggle="tab">Security</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="profileinfo">
                                            <form action="{{ route('update.user', ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Lastname</label>
                                                    <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
                                                    @error('lastname')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Firstname</label>
                                                    <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}">
                                                    @error('firstname')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <label class="col-lg-3 col-form-label">Gender</label>
                                                <div class="form-group row">
                                                    <div class="col-lg-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="male" {{ $user->gender === 'male' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="gender">
                                                                Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="female" {{ $user->gender === 'female' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="gender">
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('gender')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="text" name="birthdate" class="form-control" onfocus="(this.type = 'date')" value="{{ \Carbon\Carbon::parse($user->birthdate)->format('m/d/Y') }}">
                                                    @error('birthdate')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <label class="col-lg-3 col-form-label">Role</label>
                                                <div class="form-group row">
                                                    <div class="col-lg-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="role" id="admin" value="admin" {{ $user->usertype === 'admin' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="admin">
                                                                Admin
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="role" id="staff" value="staff" {{ $user->usertype === 'staff' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="staff">
                                                                Staff
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="role" id="patient" value="patient" {{ $user->usertype === 'patient' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="patient">
                                                                Patient
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('role')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="security">
                                            <form action="{{ route('update.user-sec', ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Current Password</label>
                                                    <input type="password" name="current_password" class="form-control">
                                                    @error('current_password')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" name="password" class="form-control">
                                                    @error('password')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control">
                                                    @error('password_confirmation')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="footer">
                    <div class="credit">
                        Created By <span>EyeCare</span> | All Rights Reserved.
                    </div>
                </section>
            </div>
        </div>
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/js/script.js')}}"></script>
    </body>
</html>