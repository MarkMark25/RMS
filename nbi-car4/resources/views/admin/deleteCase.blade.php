<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <title>NBI-CAR</title>

    <!-- Bootstrap core CSS-->
    <link href="{{URL::to('bower_components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet')}}">
    <link href="{{URL::to('bower_components/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{URL::to('bower_components/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{URL::to('bower_components/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{URL::to('bower_components/css/sb-admin.css')}}" rel="stylesheet">

    <!--TAB IMAGE -->
    <link rel="icon" href="{{URL::to('bower_components/image/nbi-logo.png')}}">

    <!--DATE PICKER AND ADD FIELDS START HERE-->
    <!--DATE PICKER1-->
    <!-- EXTRA CSS
    <link href="{{URL::to('bower_components/datepicker/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    -->
    <script src="{{URL::to('bower_components/datepicker/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::to('bower_components/datepicker/jquery-ui.css')}}">
    <script src="{{URL::to('bower_components/datepicker/jquery-1.11.1.min.js')}}"></script>
    <script src="{{URL::to('bower_components/datepicker/jquery-ui.js')}}"></script>
    <!--DATE PICKER2-->
    <link rel="stylesheet" href="{{URL::to('bower_components/datepicker/jquery-ui1.css')}}">
    <script src="{{URL::to('bower_components/datepicker/jquery-ui1.js')}}"></script>

    <!-- JS Datepicker -->
    <script src="{{URL::to('bower_components/datepicker/date.js')}}"></script>

    <!-- Add Fields
    <script src="{{URL::to('bower_components/datepicker/addFields.js')}}"></script>
    -->

    <style>
        .input-group:not(:first-of-type) { margin-top: 10px; }
            input::placeholder {
                font-style: italic;
            }
            textarea::placeholder{
                font-style: italic;
            }
    </style>

</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="/encoderHome">NBI-CAR</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <!--
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        -->
            </div>
        </form>

        @if (session('status')) {{ session('status') }} @endif
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @else

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i> {{ Auth::user()->firstName}} {{ Auth::user()->lastName}} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/profile">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/adminHome">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Manage Case</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/caseReport">Case Records</a>
                    <a class="dropdown-item" href="/ComplaintSheet">Add Case</a>
                    <a class="dropdown-item" href="/caseNature">Case Nature</a>
                    <a class="dropdown-item" href="/caseStatus">Case Status</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Generate Report</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/ccnAcmoReques">CCN Request</a>
                    <!-- add page for case records-->
                    <a class="dropdown-item" href="/terminatedCases">Transmittal</a>
                    <!-- add page -->
                    <a class="dropdown-item" href="/terminatedCrimeCase">Terminated Crimes</a>
                    <!-- add page -->
                    <a class="dropdown-item" href="/pendingCrimes">Pending Crimes</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Manage Accounts</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="/manageAccounts">User Monitoring</a>
                    <!-- add page for case records-->
                    <a class="dropdown-item" href="/userLogs">User Logs</a>
                    <!-- add page -->
                    <a class="dropdown-item" href="/userHistory">User History</a>
                    <!-- add page -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-archive"></i>
                <span>Archived</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    {{-- Archiving of Records
                    <a class="dropdown-item" href="/archivedRecords">Case Records</a>
                    --}}
                    <a class="dropdown-item" href="/archivedNature">Case Nature</a>
                </div>
            </li>
        </ul>
        <div id="content-wrapper">
            <a href="/caseReport" class="btn btn-secondary" style="margin-left:20px;">
                <i class="fas fa-backward"></i>
                <span>Back</span>
            </a>

            <div class="container-fluid" style="padding-bottom:3%; padding-top:2%;">
                <div class="card mb-3" style="width:100%%;">
                    <form action="/caseDeleted" method="POST">
                        {{ csrf_field() }}
                        <center>
                            <div class="card-header">
                                <h4>Review the case and click <strong>"ARCHIVE"</strong></div>
                        </center>
                        <div class="card-body">
                            @foreach ($cases as $cases)
                            <input type="hidden" id="caseID" name="caseID" class="form-control" value="{{ $cases->caseid }}" readonly>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="ccn">CCN</label>
                                        <input type="text" id="ccn" name="ccn" class="form-control" value="{{ $cases->ccn }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="acmo">ACMO No.</label>
                                        <input type="text" id="acmo" class="form-control" value="{{ $cases->acmo}}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="caseNumber">Car Case Number</label>
                                        <div class="input-group mb-2">
                                            <input type="text" id="docketnumber" name="docketnumber" class="form-control" value="{{ $cases->docketnumber }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="dateTerminated">Date Terminated</label>
                                        <input type="text" id="dateTerminated" name="dateTerminated" class="form-control" value="{{ $cases->dateTerminated}}" disabled>
                                    </div>
                                    @endforeach @foreach ($status as $status)
                                    <div class="col-md-4">
                                        <label for="status">Status</label>
                                        <input type="text" id="status" name="status" class="form-control" value="{{ $status->status}}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                @foreach ($agent as $agent)
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="agent">Investigator</label>
                                                    <input type="text" id="full_name" name="full_name" class="form-control" value="{{ $agent->agentName}}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="agent">Date Assigned</label>
                                                    <input type="text" id="dateAssigned" name="dateAssigned" class="form-control" value="{{ $agent->dateassigned}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="form-group">
                                <p style="font-weight:bold;">1. Complainant</p>
                                <div class="form-row">
                                    @foreach ($casesComplaint as $casesComplaint)
                                    <div class="col-md-4">
                                        <label for="suspectName">Name</label>
                                        <div class="">
                                            <input type="text" id="complainant" name="complainant" class="form-control" value="{{ $casesComplaint->complainantname}}" disabled/> {{-- QUERY HERE --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Address</label>
                                        <div class="">
                                            <input type="text" id="complainantAddress" name="complainantAddress" class="form-control" value="{{ $casesComplaint->complainant_Address}}" disabled/> {{-- QUERY HERE --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Telephone Number</label>
                                        <div class="">
                                            <input type="text" id="complainantTelNumber" name="complainantTelNumber" class="form-control" value="{{ $casesComplaint->complainant_Contact_Number}}" disabled/> {{-- QUERY HERE --}}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <p style="font-weight:bold;">2. Persons Complained Against or Suspects</p>
                                <div class="form-row">
                                    @foreach($suspect as $suspect)
                                    <div class="col-md-3">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="suspectNameA" name="suspectNameA" value="{{ $suspect->suspect_name }}" style="background-color:#dd8282;" disabled>
                                        <label for="">Age</label>
                                    @if ($suspect->suspect_Age2 === null)
                                        <input type="text" class="form-control" id="suspectAge" name="suspectAge"  value="{{ $suspect->suspect_Age }}" disabled>
                                    @else
                                        <input type="text" class="form-control" id="suspectAge" name="suspectAge"  value="{{ $suspect->suspect_Age }} - {{ $suspect->suspect_Age2 }}" disabled>
                                    @endif
                                    <label for="">Height</label>
                                    @if ($suspect->height2 === null)
                                        <input type="text" class="form-control"  value="{{ $suspect->height }}" disabled>
                                    @else
                                        <input type="text" class="form-control"  value="{{ $suspect->height }} - {{ $suspect->height2 }}" disabled>
                                    @endif
                                    <label for="">Skin tone</label>
                                        <input type="text" class="form-control"  value="{{ $suspect->skin_tone }}" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" id="suspectAddressA" name="suspectAddressA" value="{{ $suspect->suspect_Address }}" disabled>
                                        <label for="">Civil Status</label>
                                        <input type="text" class="form-control" id="suspectCivilStatusA" name="suspectCivilStatusA" value="{{ $suspect->suspect_Civil_Status }}" disabled>
                                        <label for="">Weight</label>
                                        @if ($suspect->weight2 === null)
                                            <input type="text" class="form-control"  value="{{ $suspect->weight }}" disabled>
                                        @else
                                            <input type="text" class="form-control"  value="{{ $suspect->weight }} - {{ $suspect->weight2 }}" disabled>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Telephone Number</label>
                                        <input type="text" class="form-control" id="suspectTelNumberA" name= "suspectTelNumberA" value="{{ $suspect->suspect_Contact_Number }}" disabled>
                                        <label for="">Occupation</label>
                                        <input type="text" class="form-control" id="suspectOccupationA" name="suspectOccupationA" value="{{ $suspect->suspect_Occupation }}" disabled>
                                        <label for="">Eye Color</label>
                                        <input type="text" class="form-control"  value="{{ $suspect->eye_color }}" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Sex</label>
                                        <input type="text" class="form-control" id="suspectSexA" name="suspectSexA" value="{{ $suspect->suspect_Sex }}" disabled>
                                        <label for="">Status</label>
                                        @if($suspect->status === "Guilty")
                                        <input type="text" class="form-control" style="background-color:#dd8282;font-weight:bold;" id="statusA" name="statusA" value="{{ $suspect->status }}" disabled>
                                        @else
                                        <input type="text" class="form-control" style="background-color:#a0efa4;" id="statusA" name="statusA" value="{{ $suspect->status }}" disabled>
                                        @endif
                                        <label for="">Hair Color</label>
                                        <input type="text" class="form-control"  value="{{ $suspect->hair_color }}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <p style="font-weight:bold;">3. Nature of act complained</p>
                            <section>
                                <div class="form-group">
                                    <div class="form-row">
                                        @foreach($nature as $nature)
                                        <div class="col-md-4">
                                            <input class="form-control" name="nameOfNature" id="nameOfNature" value="{{ $nature->nature}}" disabled>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">4. Where and when committed</p>
                                    <div class="form-row">
                                        @if (!$count)
                                        <div class="col-md-6">
                                            <label for="whereCommitted">Place Committed</label>
                                            <input type="text" name="whereCommitted" id="whereCommitted" class="form-control" value="" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="whenCommitted">When Committed</label>
                                            <input type="text" name="wheneCommitted" id="wheneCommitted" class="form-control" value="" disabled>
                                        </div>
                                        @else @foreach($whenAndWhere as $whenAndWhere)
                                        <div class="col-md-6">
                                            <label for="whereCommitted">Place Committed</label>
                                            <input type="text" name="whereCommitted" id="whereCommitted" class="form-control" value="{{ $whenAndWhere->place_Committed }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="whenCommitted">When Committed</label>
                                            <input type="text" name="wheneCommitted" id="wheneCommitted" class="form-control" value="{{ $whenAndWhere->date_Committed }}" disabled>
                                        </div>
                                        @endforeach @endif
                                    </div>
                                </div>
                            </section>
                            <hr>
                            <div class="form-group">
                                <p style="font-weight:bold;">5. Victim/s If any</p>
                                <div class="form-row">
                                    @foreach($victim as $victim)
                                    <div class="col-md-3">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="victimNameA" name="victimNameA" value="{{ $victim->victim_name }}" style="background-color:#dd8282;" disabled>
                                        <label for="">Age</label>
                                        <input type="text" class="form-control" id="victimAge" name="victimAge" value="{{ $victim->victim_Age }}" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" id="victimAddressA" name="victimAddressA" value="{{ $victim->victim_Address }}" disabled>
                                        <label for="">Civil Status</label>
                                        <input type="text" class="form-control" id="victimCivilStatusA" name="victimCivilStatusA" value="{{ $victim->victim_Civil_Status }}" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Telephone Number</label>
                                        <input type="text" class="form-control" id="victimTelNumberA" name="victimTelNumberA" value="{{ $victim->victim_Contact_Number }}" disabled>
                                        <label for="">Occupation</label>
                                        <input type="text" class="form-control" id="victimOccupationA" name="victimOccupationA" value="{{ $victim->victim_Occupation }}" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Sex</label>
                                        <input type="text" class="form-control" id="victimSexA" name="victimSexA" value="{{ $victim->victim_Sex }}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr> @if (!$count)
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">6. Narration of Facts </p>
                                    <textarea id="narrationOfFacts" name="narrationOfFacts" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what people agency?</p>
                                    <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
                                    <br>
                                    <p style="font-weight:bold;">Status of investigation, If any</p>
                                    <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where?</p>
                                    <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI?</p>
                                    <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
                                </div>
                            </section>
                            @else @foreach($complaintSheet as $complaintSheet)
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">6. Narration of Facts</p>
                                    <textarea id="narrationOfFacts" name="narrationOfFacts" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $complaintSheet->narration_Of_Facts }}</textarea>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what people agency?</p>
                                    <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $complaintSheet->reported_Any_Agency }}</textarea>
                                    <br>
                                    <p style="font-weight:bold;">Status of investigation, If any</p>
                                    <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $complaintSheet->status_of_Investigation }}</textarea>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where?</p>
                                    <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $complaintSheet->where_court_Proceedings }}</textarea>
                                </div>
                            </section>
                            <hr>
                            <section>
                                <div class="form-group">
                                    <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI?</p>
                                    <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $complaintSheet->report_Considerations }}</textarea>
                                </div>
                            </section>
                            @endforeach @endif
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="">
                                            <input type="hidden" id="caseAvailability" name="caseAvailability" class="form-control" value="Deleted">
                                            <input type="hidden" id="descriptionOne" name="descriptionOne" class="form-control" value="Administrator archived the case with docketnumber = ">
                                            <input type="hidden" id="action" name="action" class="form-control" value="Archived"> {{-- QUERY HERE --}}
                                            <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--CLOSING CARD HEADER -->
                        <div class="modal-footer">
                            <center>
                                <button type="submit" class="btn btn-primary"><strong>ARCHIVE</strong></button>
                            </center>
                        </div>
                    </form>
                </div>
                <!--CLOSING CARD REGISTER -->
            </div>
            <!--CLOSING CONTAINER FLUID -->
        </div>
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © eCaseRecord-NBI 2018-2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateDate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9,C,-]/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        function validateCCN(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9,I,-]/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        function validateACMO(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9,C,-]/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        function validateComplainant(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[a-z,A-Z, ]/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>

    <!-- Custom scripts for all pages -->
    <script src="{{URL::to('bower_components/js/sb-admin.min.js')}}"></script>
    <script src="{{URL::to('bower_components/js/demo/datatables-demo.js')}}"></script>
    <script src="{{URL::to('bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!--THIS IS A COMMENT, BELOW ARE COMMENTS AND IT CANNOT RUN
      Bootstrap core JavaScript
    <script src="bower_components/vendor/jquery/jquery.min.js"></script>
     Core plugin JavaScript
    <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>
     Page level plugin JavaScript
    <script src="bower_components/vendor/datatables/jquery.dataTables.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.bootstrap4.js"></script>
     Demo scripts for this page-->

</body>
@endguest

</html>
