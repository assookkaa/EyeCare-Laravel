<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                        <li class="active">
                            <a href="{{route('home')}}"><i class="fa-regular fa-house fa-2xs"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{route('appointment')}}"><i class="fa-regular fa-suitcase-medical fa-2xs"></i> <span>Appointment</span></a>
                        </li>
                        <li>
                            <a href="{{route('checkup')}}"><i class="fa-regular fa-hospitals fa-2xs"></i> <span>Check-up</span></a>
                        </li>
                        <li>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                    <i class="fa-regular fa-hospital-user fa-xs"></i>
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Total User</a>
                                        <a href="#" class="count"> {{ $usersCount }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                    <i class="fa-regular fa-users-medical fa-xs"></i>
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Total Patient</a>
                                        <a href="#" class="count"> {{ $patientsCount }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                        <i class="fa-regular fa-suitcase-medical fa-xs"></i>
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Request Appointment</a>
                                        <a href="#" class="count">{{ $pendingCount }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                        <i class="fa-regular fa-suitcase-medical fa-xs"></i>
                                    </span>
                                    <div class="dash-count">
                                        <a href="#" class="count-title">Today&apos;s Appointment</a>
                                        <a href="#" class="count">{{ $todayCount }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex">

                        <div class="card card-table flex-fill">
                            <div class="card-header">
                                <h4 class="card-title float-start">New Users</h4>
                                <!-- <div class="table-search float-end">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                </div> -->
                            </div>
                            <div class="card-body">
                                <div class="table-responsive no-radius">
                                    <table class="table table-hover table-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Birth Date</th>
                                                <th>Email Address</th>
                                                <th>Role</th>
                                                <th class="text-end">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>
                                                    <div>{{ $user->custom_id }}</div>
                                                </td>
                                                <td>
                                                    <h2>
                                                        <a class="user-name" href="{{route('general_settings', $user->id)}}">{{ $user->lastname }}, {{ $user->firstname }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ ucfirst($user->gender) }}</td>
                                                <td>{{ $user->birthdate }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ucfirst($user->usertype) }}</td>
                                                <td class="text-center">
                                                @if ($user->status === 'active')
                                                    <div class="font-weight-600 text-success bg-success-light">Active</div>
                                                @else
                                                    <div class="font-weight-600 text-danger bg-danger-light">Inactive</div>
                                                @endif
                                                </td>   
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No new user found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
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