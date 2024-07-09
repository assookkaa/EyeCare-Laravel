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
                            <li class="active">
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
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Appointment</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Appointment</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#bottom-tab1"
                                data-bs-toggle="tab">All</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab2"
                                data-bs-toggle="tab">Request</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="bottom-tab1">
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
                                                    <button class="btn btn-icons" data-bs-toggle="modal" data-bs-target="#add-app" data-original-title="" title="Walk-in Appointment"><i class="fa-regular fa-file-circle-plus"></i></button>
                                                    <div class="dropdown">
                                                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Export">
                                                            <i class="btn btn-icons fa-regular fa-file-export"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item appSaveAsCSV"><i class="fa-solid fa-file-csv exporter-file-icons"></i><span class="exporter-file-icons mx-2">CSV</span></button>
                                                            <button class="dropdown-item appSaveAsExcel"><i class="fa-solid fa-file-excel exporter-file-icons"></i><span class="exporter-file-icons mx-2">Excel</span></button>
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
                                                            <th>Patient ID</th>
                                                            <th>Name</th>
                                                            <th>Gender</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th>Status</th>
                                                            <th class="text-end">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse ($appointments as $appointment)
                                                        <tr>
                                                            <td>{{ $appointment->custom_id }}</td>
                                                            <td>{{ $appointment->patient_id }}</td>
                                                            <td>
                                                                <h2>
                                                                    <a class="user-name" href="{{route('general_settings', $appointment->user)}}">{{ $appointment->lastname }}, {{ $appointment->firstname }}</a>
                                                                </h2>
                                                            </td>
                                                            <td>{{ ucfirst($appointment->gender) }}</td>
                                                            <td>{{ $appointment->date }}</td>
                                                            <td>{{ $appointment->time }}</td>
                                                            <td>{{ ucfirst($appointment ->note ) }}</td>
                                                            <td class="text-center">
                                                            @if ($appointment->status === 'toCheckup')
                                                                <div class="font-weight-600 bg-success-light text-success">Approved</div>
                                                            @elseif  ($appointment->status === 'processed')
                                                                <div class="font-weight-600 bg-success-light text-success">{{ ucfirst($appointment->status) }}</div>
                                                            @elseif  ($appointment->status === 'pending')
                                                                <div class="font-weight-600 bg-warning-light text-warning">{{ ucfirst($appointment->status) }}</div>
                                                            @elseif  ($appointment->status === 'declined')
                                                                <div class="font-weight-600 bg-danger-light text-danger">{{ ucfirst($appointment->status) }}</div>
                                                            @else
                                                                <div class="font-weight-600 bg-danger-light text-danger">{{ ucfirst($appointment->status) }}</div>
                                                            @endif
                                                            </td> 
                                                            <td class="text-end">
                                                                <div class="actions">
                                                                    <form action="{{route('appointment.delete', $appointment->id)}}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                        <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete this appointment?')" title="Delete">
                                                                        <i class="fa-regular fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9" class="text-center">No appointments found.</td>
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
                        <div class="tab-pane" id="bottom-tab2">
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
                                                    <div class="dropdown">
                                                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Export">
                                                            <i class="btn btn-icons fa-regular fa-file-export"></i>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item reqSaveAsCSV"><i class="fa-solid fa-file-csv exporter-file-icons"></i><span class="exporter-file-icons mx-2">CSV</span></button>
                                                            <button class="dropdown-item reqSaveAsExcel"><i class="fa-solid fa-file-excel exporter-file-icons"></i><span class="exporter-file-icons mx-2">Excel</span></button>
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
                                                            <th>Patient ID</th>
                                                            <th>Name</th>
                                                            <th>Gender</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th>Status</th>
                                                            <th class="text-end">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse ($reqAppointments as $req)
                                                        <tr>
                                                            <td>{{ $req->custom_id }}</td>
                                                            <td>{{ $req->patient_id }}</td>
                                                            <td>
                                                                <h2>
                                                                    <a class="user-name" href="{{route('general_settings', $req->user)}}">{{ $req->lastname }}, {{ $req->firstname }}</a>
                                                                </h2>
                                                            </td>
                                                            <td>{{ ucfirst($req->gender) }}</td>
                                                            <td>{{ $req->date }}</td>
                                                            <td>{{ $req->time }}</td>
                                                            <td>{{ ucfirst($req->note ) }}</td>
                                                            <td class="text-center">
                                                                <div class="font-weight-600 bg-warning-light text-warning">{{ ucfirst($req->status) }}</div>
                                                            </td> 
                                                            <td class="text-end">
                                                                <div class="actions">
                                                                    <form action="{{route('appointment.accept', $req->id)}}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                        <button type="submit" class="btn btn-sm bg-success-light" onclick="return confirm('Are you sure you want to accept this appointment?')" title="Accept">
                                                                        <i class="fa-regular fa-check"></i>
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{route('appointment.decline', $req->id)}}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                        <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to decline this appointment?')" title="Decline">
                                                                        <i class="fa-regular fa-xmark"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">No request appointments found.</td>
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
                    </div>
                    <div class="modal fade" id="add-app" tabindex="-1" role="dialog" aria-labelledby="add-appTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{route('appointment-walkin')}}" method="POST">
                                @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add-appTitle">Walk-in Appointment </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Patient ID" name="patient_id">
                                                    @error('patient_id')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Date" name="date" onfocus="(this.type = 'date')">
                                                    @error('date')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="time">
                                                        <option>Select Time</option>
                                                        <option value="8:00 am">8:00 am</option>
                                                        <option value="8:15 am">8:15 am</option>
                                                        <option value="8:30 am">8:30 am</option>
                                                        <option value="8:45 am">8:45 am</option>
                                                        <option value="9:00 am">9:00 am</option>
                                                        <option value="9:15 am">9:15 am</option>
                                                        <option value="9:30 am">9:30 am</option>
                                                        <option value="9:45 am">9:45 am</option>
                                                        <option value="10:00 am">10:00 am</option>
                                                        <option value="10:15 am">10:15 am</option>
                                                        <option value="10:30 am">10:30 am</option>
                                                        <option value="10:45 am">10:45 am</option>
                                                        <option value="11:00 am">11:00 am</option>
                                                        <option value="11:15 am">11:15 am</option>
                                                        <option value="11:30 am">11:30 am</option>
                                                        <option value="11:45 am">11:45 am</option>
                                                    </select>
                                                    @error('time')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea rows="6" class="form-control" placeholder="Note" name="note"></textarea>
                                                    @error('note')
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