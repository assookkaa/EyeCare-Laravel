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
                            <li class="active">
                                <a href="{{route('home')}}"><i class="fa-regular fa-house fa-2xs"></i> <span>Home</span></a>
                            </li>
                            <li>
                                <a href="{{route('patient_records')}}"><i class="fa-regular fa-notes-medical fa-2xs"></i> <span>Results</span></a>
                            </li>
                            <li>
                                <a href="{{route('patients_history')}}"><i class="fa-regular fa-rectangle-history"></i> <span>History</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#bottom-tab1" data-bs-toggle="tab">Book</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-bs-toggle="tab">Approved</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-bs-toggle="tab">Completed</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-bs-toggle="tab">Declined</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="bottom-tab1">
                            <div class="row">
                                <div class="col-md-12 d-flex">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between gap-1">
                                                <div class="d-flex justify-content-start gap-1">
                                                    <div class="form-group">
                                                        <input id="search" type="text" class="form-control" placeholder="Search">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end gap-1">
                                                    <button class="btn btn-icons" data-bs-toggle="modal" data-bs-target="#add-app" data-original-title="" title="Walk-in Appointment"><i class="fa-regular fa-file-circle-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="mytable" class="table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Appointment ID</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th>Status</th>
                                                            <th class="text-end">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($appointments as $appointment)
                                                        <tr>
                                                            <td>{{$appointment->custom_id}}</td>
                                                            <td>{{$appointment->date}}</td>
                                                            <td>{{$appointment->time}}</td>
                                                            <td>{{$appointment->note}}</td>
                                                            <td>
                                                                <div class="font-weight-600 bg-warning-light text-center text-warning">
                                                                    {{ ucfirst($appointment->status) }}
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="actions">
                                                                    <form action="{{route('appointment.cancel', $appointment->id)}}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                        <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure you want to cancel this appointment?')" title="Cancel">
                                                                        <i class="fa-regular fa-xmark"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">No pending appointments found.</td>
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
                                                    <div class="form-group">
                                                        <input id="search" type="text" class="form-control" placeholder="Search">
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
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($apprappointments as $appointment)
                                                        <tr>
                                                            <td>{{$appointment->custom_id}}</td>
                                                            <td>{{$appointment->date}}</td>
                                                            <td>{{$appointment->time}}</td>
                                                            <td>{{$appointment->note}}</td>
                                                            <td>
                                                                <div class="font-weight-600 bg-success-light text-center text-success">
                                                                    Approved
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">No approved appointments found.</td>
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
                        <div class="tab-pane" id="bottom-tab3">
                        <div class="row">
                                <div class="col-md-12 d-flex">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between gap-1">
                                                <div class="d-flex justify-content-start gap-1">
                                                    <div class="form-group">
                                                        <input id="search" type="text" class="form-control" placeholder="Search">
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
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th>Status</th>
                                                            <th class="text-end">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($procappointments as $appointment)
                                                        <tr>
                                                            <td>{{$appointment->custom_id}}</td>
                                                            <td>{{$appointment->date}}</td>
                                                            <td>{{$appointment->time}}</td>
                                                            <td>{{$appointment->note}}</td>
                                                            <td>
                                                                <div class="font-weight-600 bg-success-light text-center text-success">
                                                                    {{ ucfirst($appointment->status) }}
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="actions">
                                                                    @if($appointment->has_rate === 0)
                                                                        <button class="btn btn-sm bg-success-light" data-bs-toggle="modal" data-bs-target="#rating{{$appointment->custom_id}}" title="Rating">
                                                                            <i class="fa-regular fa-star"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                                <div class="modal fade" id="rating{{$appointment->custom_id}}" tabindex="-1" role="dialog" aria-labelledby="torate{{$appointment->custom_id}}" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <form action="{{route('rating.store')}}" method="POST">
                                                                                @csrf
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="torate{{$appointment->custom_id}}">Rating</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                    <input type="hidden" name="id" value="{{ $appointment->custom_id }}">
                                                                                        <div class="form-group">
                                                                                            <select class="form-control" name="rate">
                                                                                                <option>Rate</option>
                                                                                                <option value="1">1</option>
                                                                                                <option value="2">2</option>
                                                                                                <option value="3">3</option>
                                                                                                <option value="4">4</option>
                                                                                                <option value="5">5</option>
                                                                                            </select>
                                                                                            @error('rate')
                                                                                                <p class="erno">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <textarea rows="4" class="form-control" placeholder="Feedback" name="feedback"></textarea>
                                                                                            @error('feedback')
                                                                                                <p class="erno">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-original-title="" title="">Close</button>
                                                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">No completed appointments found.</td>
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
                        <div class="tab-pane" id="bottom-tab4">
                        <div class="row">
                                <div class="col-md-12 d-flex">
                                    <div class="card card-table flex-fill">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between gap-1">
                                                <div class="d-flex justify-content-start gap-1">
                                                    <div class="form-group">
                                                        <input id="search" type="text" class="form-control" placeholder="Search">
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
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Note</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($decappointments as $appointment)
                                                        <tr>
                                                            <td>{{$appointment->custom_id}}</td>
                                                            <td>{{$appointment->date}}</td>
                                                            <td>{{$appointment->time}}</td>
                                                            <td>{{$appointment->note}}</td>
                                                            <td>
                                                                <div class="font-weight-600 bg-danger-light text-center text-danger">
                                                                    {{ ucfirst($appointment->status) }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">No declined appointments found.</td>
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
                                <form action="{{route('appoint')}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add-appTitle">Book Appointment </h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
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
                                                    <textarea rows="5" class="form-control" placeholder="Note" name="note"></textarea>
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