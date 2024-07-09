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
                            <li>
                                <a href="{{route('home')}}"><i class="fa-regular fa-house fa-2xs"></i> <span>Home</span></a>
                            </li>
                            <li>
                                <a href="{{route('patient_records')}}"><i class="fa-regular fa-notes-medical fa-2xs"></i> <span>Results</span></a>
                            </li>
                            <li class="active">
                                <a href="{{route('patients_history')}}"><i class="fa-regular fa-rectangle-history"></i> <span>History</span></a>
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
                                <h3 class="page-title">History</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item active">History</li>
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
                                            <div class="dropdown">
                                                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Export">
                                                    <i class="btn btn-icons fa-regular fa-file-export"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item hisSaveAsCSV"><i class="fa-solid fa-file-csv exporter-file-icons"></i><span class="exporter-file-icons mx-2">CSV</span></button>
                                                    <button class="dropdown-item hisSaveAsExcel"><i class="fa-solid fa-file-excel exporter-file-icons"></i><span class="exporter-file-icons mx-2">Excel</span></button>
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
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Note</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($ind_history as $history)
                                                <tr>
                                                    <td>{{$history->custom_id}}</td>
                                                    <td>{{$history->date}}</td>
                                                    <td>{{$history->time}}</td> 
                                                    <td>{{$history->note}}</td>
                                                    <td>
                                                        @if  ($history->status === 'processed')
                                                            <div class="font-weight-600 bg-success-light text-center text-success">{{ ucfirst($history->status) }}</div>
                                                        @elseif  ($history->status === 'declined')
                                                            <div class="font-weight-600 bg-danger-light text-center text-danger">{{ ucfirst($history->status) }}</div>
                                                        @else
                                                            <div class="font-weight-600 bg-danger-light text-center text-danger">{{ ucfirst($history->status) }}</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No history found.</td>
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