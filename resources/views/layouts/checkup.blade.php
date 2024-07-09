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
        <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
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
                            <li class="active">
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
                                <h3 class="page-title">Check-up</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Check-up</li>
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
                                            <button class="btn btn-icons" data-bs-toggle="modal" data-bs-target="#walkincheckup" data-original-title="" title="Walk-in Check-up"><i class="fa-regular fa-plus fa-2xs"></i></button>
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
                                                    <th>Appointment ID</th>
                                                    <th>Patient ID</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Note</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($checkups as $checkup)
                                                <tr>
                                                    <td>{{ $checkup->custom_id }}</td>
                                                    <td>{{ $checkup->patient_id }}</td>
                                                    <td>
                                                        <h2>
                                                            <a class="user-name" href="{{route('general_settings', $checkup->user)}}">{{ $checkup->lastname }}, {{ $checkup->firstname }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ ucfirst($checkup ->gender ) }}</td>
                                                    <td>{{ $checkup->date }}</td>
                                                    <td>{{ $checkup->time }}</td>
                                                    <td>{{ ucfirst($checkup ->note ) }}</td>
                                                    <td class="text-end">
                                                        <div class="actions">
                                                            <button class="btn btn-sm bg-success-light" data-bs-toggle="modal" data-bs-target="#tocheckup" data-patient-id="{{ $checkup->patient_id }}" data-appointment-id="{{ $checkup->custom_id }}"  data-original-title="" title="Check-up">
                                                            <i class="fa-regular fa-hospitals"></i>
                                                            </button>
                                                            <form action="{{route('appointment.delete', $checkup->id)}}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                                <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to delete this data?')" title="Delete">
                                                                <i class="fa-regular fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No records found.</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="tocheckup" tabindex="-1" role="dialog" aria-labelledby="tocheckupTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('result') }}" method="POST">
                                @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tocheckupTitle">Check-up Results</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="text" class="form-control" name="appointment_id" hidden readonly>
                                            <input type="text" class="form-control" name="patient_id" hidden readonly>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OS Sphere" name="os_sph">
                                                    @error('os_sph')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OS Cylinder" name="os_cyl">
                                                    @error('os_cyl')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OS Axis" name="os_axis">
                                                    @error('os_axis')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OD Sphere" name="od_sph">
                                                    @error('od_sph')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OD Cylinder" name="od_cyl">
                                                    @error('od_cyl')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OD Axis" name="od_axis">
                                                    @error('od_axis')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="PD" name="pd">
                                                @error('pd')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Add" name="add">
                                                @error('add')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="4" class="form-control" placeholder="Note" name="note"></textarea>
                                                @error('note')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
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
                    <div class="modal fade" id="walkincheckup" tabindex="-1" role="dialog" aria-labelledby="walkincheckupTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('wcheckup') }}" method="POST">
                                @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="walkincheckupTitle">Walk-in Check-up Results</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Patient" name="patient_id">
                                                @error('patient_id')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OS Sphere" name="os_sph">
                                                    @error('os_sph')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OS Cylinder" name="os_cyl">
                                                    @error('os_cyl')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OS Axis" name="os_axis">
                                                    @error('os_axis')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OD Sphere" name="od_sph">
                                                    @error('od_sph')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OD Cylinder" name="od_cyl">
                                                    @error('od_cyl')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="OD Axis" name="od_axis">
                                                    @error('od_axis')
                                                        <p class="erno">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="PD" name="pd">
                                                @error('pd')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Add" name="add">
                                                @error('add')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="4" class="form-control" placeholder="Note" name="note"></textarea>
                                                @error('note')
                                                    <p class="erno">{{ $message }}</p>
                                                @enderror
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
        <script src="{{asset('assets/js/select2.min.js')}}"></script>
        <script>
            $('#tocheckup').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var patientId = button.data('patient-id');
                var appointmentId = button.data('appointment-id');
                var modal = $(this);
                modal.find('input[name="patient_id"]').val(patientId);
                modal.find('input[name="appointment_id"]').val(appointmentId);
            });
        </script>
    </body>
</html>