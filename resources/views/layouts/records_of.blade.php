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
                                <h3 class="page-title">Records of {{ $user->firstname }} {{ $user->lastname }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Records of {{ $user->firstname }} {{ $user->lastname }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    @forelse ($checkups as $checkup)
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between gap-1">
                                        <div class="d-flex justify-content-start gap-1">
                                            <h5 class="card-title mt-2 pt-1">{{ $checkup->created_at->format('M d, Y') }}</h5>    
                                        </div>
                                        <div class="d-flex justify-content-end gap-1">
                                            <button class="btn btn-icons" title="Print"><i class="fa-regular fa-print"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"><i class="fa-solid fa-prescription"></i></th>
                                                    <th class="text-center">Spherical</th>
                                                    <th class="text-center">Cylinder</th>
                                                    <th class="text-center">Axis</th>
                                                    <th class="text-center">Add</th>
                                                    <th class="text-center">PD</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">OD</th>
                                                    <td class="text-center">{{ $checkup->od_sph }}</td>
                                                    <td class="text-center">{{ $checkup->od_cyl }}</td>
                                                    <td class="text-center">{{ $checkup->od_axis }}</td>
                                                    <td rowspan="2" class="text-center align-middle">{{ $checkup->add }}</td>
                                                    <td rowspan="2" class="text-center align-middle">{{ $checkup->pd }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">OS</th>
                                                    <td class="text-center">{{ $checkup->os_sph }}</td>
                                                    <td class="text-center">{{ $checkup->os_cyl }}</td>
                                                    <td class="text-center">{{ $checkup->os_axis }}</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
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