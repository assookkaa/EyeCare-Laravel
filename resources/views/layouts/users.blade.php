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
                                <h3 class="page-title">User Management</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">User Management</li>
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
                                        <div class="d-flex justify-content-end gap-1">
                                            <button class="btn btn-icons" data-bs-toggle="modal" data-bs-target="#add-user" data-original-title="" title="Add User"><i class="fa-regular fa-user-plus"></i></button>
                                            <div class="dropdown">
                                                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Export">
                                                    <i class="btn btn-icons fa-regular fa-file-export"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item saveAsCSV"><i class="fa-solid fa-file-csv exporter-file-icons"></i><span class="exporter-file-icons mx-2">CSV</span></button>
                                                    <button class="dropdown-item saveAsExcel"><i class="fa-solid fa-file-excel exporter-file-icons"></i><span class="exporter-file-icons mx-2">Excel</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
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
                                                    <th>Status</th>
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
                                                    <td class="text-center">
                                                    @if ($user->status === 'active')
                                                        <div class="font-weight-600 bg-success-light text-success">{{ ucfirst($user->status) }}</div>
                                                    @else
                                                        <div class="font-weight-600 bg-danger-light text-danger">{{ ucfirst($user->status) }}</div>
                                                    @endif
                                                    </td> 
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            @if ($user->status === 'active')
                                                            <form action="{{ route('users.deactivate', $user->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to deactivate this user?')" title="Deactivate">
                                                                <i class="fa-regular fa-trash"></i>
                                                                </button>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('users.activate', $user->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-sm bg-success-light" onclick="return confirm('Are you sure you want to activate this user?')" title="Activate">
                                                                <i class="fa-regular fa-ban"></i>
                                                                </button>
                                                            </form>
                                                            @endif
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
                    <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="add-userTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{route('add.user')}}" method="POST">
                                @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add-userTitle">User Information </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Lastname" name="lastname">
                                                    @error('lastname')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Firstname" name="firstname">
                                                    @error('firstname')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  onfocus="(this.type = 'date')" placeholder="Birthdate" name="birthdate">
                                                    @error('birthdate')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" value="male">
                                                        <label class="form-check-label" for="gender_male">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" value="female">
                                                        <label class="form-check-label" for="gender_female">Female</label>
                                                    </div>
                                                    @error('gender')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Email" name="email">
                                                    @error('email')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                                    @error('password')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <select class="select form-control" name="role">
                                                        <option>Select Role</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="staff">Staff</option>
                                                        <option value="patient">Patient</option>
                                                    </select> 
                                                    @error('role')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                                        <button class="btn btn-primary" type="submit" data-original-title="" title="">Submit</button>
                                    </div>
                                </form>
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