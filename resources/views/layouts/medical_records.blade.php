<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>EyeCare</title>
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
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
                            <li>
                                <a href="{{route('users')}}"><i class="fa-regular fa-hospital-user fa-2xs"></i> <span>User Management</span></a>
                            </li>
                            <li class="active">
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
                                <h3 class="page-title">Medical Records</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Medical Records</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card card-table flex-fill">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between gap-1">
                                        <div class="d-flex justify-content-start gap-1">
                                            <!-- <div class="form-group">
                                                <select class="form-control" name="" id="">
                                                    <option value="10">10</option>
                                                    <option value="30">30</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group">
                                                <input id="search" type="text" class="form-control" placeholder="Search">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body h-100vh">
                                    <div class="table-responsive">
                                        <table id="mytable" class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Birth Date</th>
                                                    <th>Email Address</th>
                                                    <th>Role</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->custom_id }}</td>     
                                                    <td>
                                                        <h2>
                                                            <a class="user-name" href="{{route('general_settings', $user->id)}}">{{ $user->lastname }}, {{ $user->firstname }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ ucfirst($user->gender) }}</td>
                                                    <td>{{ $user->birthdate }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ ucfirst($user->usertype) }}</td>
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            <a href="{{ route('records_of', $user->custom_id) }}" class="btn btn-sm bg-success-light" ><i class="fa-regular fa-eye" title="View Records"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No user found.</td>
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
        <script src="{{asset('assets/js/xlsx.full.min.js')}}"></script>
        <script src="{{asset('assets/js/FileSaver.min.js')}}"></script>
        <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>
        <script src="{{asset('assets/js/script.js')}}"></script>
        <script src="{{asset('assets/js/file-exporter.js')}}"></script>
    </body>
</html>