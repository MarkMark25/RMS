<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NBI-CAR</title>

    <!-- Bootstrap core CSS-->
    <link href="bower_components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="bower_components/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="bower_components/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="bower_components/css/sb-admin.css" rel="stylesheet">

    <!--TAB IMAGE -->
    <link rel="icon"  href="bower_components/image/nbi-logo.png">

    <!--DATE PICKER AND ADD FIELDS START HERE-->
    <!--DATE PICKER1-->
    <!-- EXTRA CSS
    <link href="bower_components/datepicker/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    -->
    <script src="bower_components/datepicker/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bower_components/datepicker/jquery-ui.css">
    <script src="bower_components/datepicker/jquery-1.11.1.min.js"></script>
    <script src="bower_components/datepicker/jquery-ui.js"></script>
    <!--DATE PICKER2-->
    <link rel="stylesheet" href="bower_components/datepicker/jquery-ui1.css">
    <script src="bower_components/datepicker/jquery-ui1.js"></script>

    <!-- JS Datepicker -->
    <script src="bower_components/datepicker/date.js"></script>
    <script src="bower_components/datepicker/addCase.js"></script>

    <!-- Add Fields
    <script src="bower_components/datepicker/addFields.js"></script>
    -->
    <style>
            .input-group:not(:first-of-type) {
                margin-top: 10px;
            }
            input::placeholder {
                font-style: italic;
            }
            th {
                font-size:16px;
            }
            td {
                font-size:14px;
            }
            thead input {
                width: 100%;
                padding: 3px;
                box-sizing: border-box;
            }
            tfoot input {
                width: 100%;
                padding: 3px;
                box-sizing: border-box;
            }
    </style>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1 " href="/">NBI-CAR</a>

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

      @if (session('status'))

      {{ session('status') }}

        @endif
            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @else

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
            {{ Auth::user()->firstName}} {{ Auth::user()->lastName}} <span class="caret"></span>
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

 <!-- Sidebar -->
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
                        <a class="dropdown-item" href="/ccnAcmoRequest">CCN Request</a>
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
                <a class="dropdown-item" href="/manageAccounts">User Monitoring</a> <!-- add page for case records-->
                <a class="dropdown-item" href="/userLogs">User Logs</a>  <!-- add page -->
                <a class="dropdown-item" href="/userHistory">User History</a>  <!-- add page -->
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
    <div class="container-fluid" style="padding-top:3%;padding-bottom:2%;">
    <a class="btn btn-primary" style="float: left" href="/caseReport"><i class="fas fa-backward"> Go back to case  records</i></a>
      <br><br>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <center><i class="fas fa-lock"></i>
                  <font size="5">Suspects Table</font>
              </center>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
            <form action="/searchResult" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <br>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Age Range</label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                            <input type="number"  value="{{ old('suspectAge') }}" name="suspectAge" max="150" min="9" placeholder="Age" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                            <input type="number"  value="{{ old('suspectAgeTwo') }}" name="suspectAgeTwo" max="150" min="9" placeholder="Age" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Weight Range</label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                            <input type="number" value="{{ old('suspectWeight') }}" name="suspectWeight" max="700" min="15" placeholder="Weight" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                            <input type="number" value="{{ old('suspectWeightTwo') }}" name="suspectWeightTwo" max="700" min="15" placeholder="Weight" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Height Range</label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                            <input type="number" value="{{ old('suspectHeight') }}" name="suspectHeight" max="300" min="50" placeholder="Height" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                            <input type="number" value="{{ old('suspectHeightTwo') }}" name="suspectHeightTwo" max="300" min="50" placeholder="Height" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <center>
                            <button class="btn btn-primary btn-block col-md-2" onclick="validateRangeAge();validateRangeHeight();validateRangeWeight();" type="submit">Search</button>
                        </center>
                    </div>
                </div>
            </form>
            <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th style="width:10%;" width="10">Docketnumber</th>
                        <th style="width:10%;" width="10">Suspect Name</th>
                        <th style="width:10%;" width="10">Sex</th>
                        <th style="width:10%;" width="10">Eye Color</th>
                        <th style="width:10%;" width="10">Skin Tone</th>
                        <th style="width:10%;" width="10">Hair Color</th>
                        <td style="width:5%;" width="10">Height</td>
                        <td style="width:5%;" width="10">Weight</td>
                        <td style="width:5%;" width="10">Age</td>
                        <td style="width:5%;" width="10">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($showData as $showData)
                      <tr>
                        <td style="width:10%;">{{$showData->docketnumber}}</td>
                        <td style="width:10%;">{{$showData->suspect_name}}</td>
                        <td style="width:10%;">{{$showData->suspect_Sex}}</td>
                        <td style="width:10%;">{{$showData->eye_color}}</td>
                        <td style="width:10%;">{{$showData->skin_tone}}</td>
                        <td style="width:10%;">{{$showData->hair_color}}</td>
                        <td style="width:5%;">
                            @if ($showData->height2 === null)
                            {{ $showData->height }}
                            @else
                            {{$showData->height}} - {{$showData->height2}}
                            @endif
                        </td>
                        <td style="width:5%;">
                            @if ($showData->weight2 === null)
                            {{ $showData->weight }}
                            @else
                            {{$showData->weight}} - {{$showData->weight2}}
                            @endif
                        </td>
                        <td style="width:5%;">
                            @if ($showData->suspect_Age2 === null)
                                {{ $showData->suspect_Age }}
                            @else
                                {{ $showData->suspect_Age }} - {{ $showData->suspect_Age2 }}
                            @endif
                        </td>
                        <td style="width:5%;">
                            <a href="/searchDetails/{{ $showData->caseID }}" class="btn-default btn-xs btn-filter">
                                <span style="color:#008000;font-weight:bold;" class="">View</span>
                            </a>
                        </td>

                      </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                                <th style="width:10%;" width="10">Docketnumber</th>
                                <th style="width:10%;" width="10">Suspect Name</th>
                                <th style="width:10%;" width="10">Sex</th>
                                <th style="width:10%;" width="10">Eye Color</th>
                                <th style="width:10%;" width="10">Skin Tone</th>
                                <th style="width:10%;" width="10">Hair Color</th>
                                <td style="width:5%;" width="10">Height</td>
                                <td style="width:5%;" width="10">Weight</td>
                                <td style="width:5%;" width="10">Age</td>
                                <td style="width:5%;" width="10">Action</td>
                        </tr>
                    </tfoot>

                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

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
            <a class="btn btn-primary" href="{{ route('logout') }}"
                onclick="event.preventDefault();
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
    {{-- Advanced Search --}}
    <div class="modal fade" id="globalSearchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Suspect Advanced Search</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="/searchResult" method="POST">
                      {{csrf_field()}}
                    @include('admin.search.suspectAdvancedSearch')
                    <hr>
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-primary">Advanced Search</button>
                        </center>
                    </div>
                  </form>
                </div>
          </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="bower_components/vendor/jquery/jquery.min.js"></script>
    <script src="bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="bower_components/vendor/datatables/jquery.dataTables.js"></script>
    <script src="bower_components/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="bower_components/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="bower_components/js/demo/datatables-demo.js"></script>
    <!-- MODAL
    <script src="bower_components/datepicker/caseReport.js"></script>
    -->
    {{--
    <script>
        $('#moreButton').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var  = button.data('')

            var modal = $(this)
            modal.find('.modal-body #').val()
          })
    </script>
    --}}
    <script>
        function validateRangeHeight(){
            var suspectHeightOne = document.getElementById('suspectHeight').value;
            var suspectHeightTwo = document.getElementById('suspectHeightTwo').value;

            if( suspectHeightOne == "" && suspectHeightTwo == "" ){
                return true;
            }else if( suspectHeightOne !== "" && suspectHeightTwo !== "" ){
                if(suspectHeightOne >= suspectHeightTwo){
                    alert('HEIGHT: Invalid input, the second input must be higher than the first input.')
                    return false;
                }else{
                    return true;
                }
            }else if(suspectHeightOne == "" && suspectHeightTwo !== ""){
                alert('You must fill up the first height.')
                return false;
            }else{
                return true;
            }

        }
        function validateRangeAge(){
            var displayAge = document.getElementById('suspectAge').value;
            var suspectAgeTwo = document.getElementById('suspectAgeTwo').value;

            if( displayAge == "" && suspectAgeTwo == "" ){
                return true;
            }else if( displayAge !== "" && suspectAgeTwo !== "" ){
                if(displayAge >= suspectAgeTwo){
                    alert('Age: Invalid input, the second input must be higher than the first input.')
                    return false;
                }else{
                    return true;
                }
            }else if(displayAge == "" && suspectAgeTwo !== ""){
                alert('You must fill up the first age.')
                return false;
            }else{
                return true;
            }

        }
        function validateRangeWeight(){
            var suspectWeightTwo = document.getElementById('suspectWeightTwo').value;
            var suspectWeightOne = document.getElementById('suspectWeight').value;

            if( suspectWeightOne == "" && suspectWeightTwo == "" ){
                return true;
            }else if( suspectWeightOne !== "" && suspectWeightTwo !== "" ){
                if(suspectWeightOne >= suspectWeightTwo){
                    alert('WEIGHT: Invalid input, the second input must be higher than the first input.')
                    return false;
                }else{
                    return true;
                }
            }else if(suspectWeightOne == "" && suspectWeightTwo !== ""){
                alert('You must fill up the first weight.')
                return false;
            }else{
                return true;
            }

        }
    </script>
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#dataTable thead th').each( function (i) {
                var title = $('#dataTable thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="inputTable" placeholder="'+title+'" data-index="'+i+'" style="width:100%;"/>' );
            } );

            // DataTable
            var table = $('#dataTable').DataTable( {
                scrollY:        "auto",
                scrollX:        true,
                scrollCollapse: true,
                paging:         true,
                destroy:        true,
                fixedColumns:   true
            } );

            // Filter event handler
            $( table.table().container() ).on( 'keyup', 'thead input', function () {
                table
                    .column( $(this).data('index') )
                    .search( this.value )
                    .draw();
            } );
        } );
    </script>
  </body>
  @endguest
</html>
