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
    <link href="bower_components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="bower_components/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="bower_components/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="bower_components/css/sb-admin.css" rel="stylesheet">

    <!--TAB IMAGE -->
    <link rel="icon"  href="bower_components/image/nbi-logo.png">

      <script src="bower_components/vendor/jquery/jquery.min.js"></script>
      <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!--Column search -->
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
        .input-group:not(:first-of-type) {
            margin-top: 10px;
        }
        input::placeholder {
            font-style: italic;
        }
        textarea::placeholder{
            font-style: italic;
        }
        td {
            font-size: 14px;
        }
        th {
            font-size: 15px;
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
            <a class="dropdown-item" href="/encoderProfile">Profile</a>
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
                  <a class="nav-link" href="/encoderHome">
                      <i class="fas fa-fw fa-home"></i>
                      <span>Home</span></a>
          </li>
          <li class="nav-item active">
              <a class="nav-link" href="/encoderCCN"> <!--LINK HERE -->
              <i class="fas fa-fw fa-paste"></i>
              <span>Update case details</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/complaintSheet"> <!--LINK HERE -->
              <i class="fas fa-fw fa-newspaper"></i>
              <span>Add Case</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/caseRecords"> <!--LINK HERE -->
            <i class="fas fa-fw"></i>
            <span>Case Records</span></a>
        </li>
        </ul>

      <div id="content-wrapper">

        <div class="container-fluid" style="padding-top:3%;padding-bottom:2%;">
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Encoder Update CCN
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
            </div> <!-- end .flash-message -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width:100%;" cellspacing="0">
                  <thead>
                    <tr>
                        <th  style="display:none;">ID</th>
                        <th>CAR Case Number</th>
                        <th>Complainant</th>
                        <th>Subject</th>
                        <th>Case Nature</th>
                        <th>Investigator</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($showData as $showData)
                        <tr>
                            <td  style="display:none;">{{ $showData->caseid }}</td>
                            <td>NBI-CAR-{{ $showData->docketnumber }}</td>
                            <td>{{ $showData->complainantname }}</td>
                            <td>{{ $showData->suspectName }}</td>
                            <td>{{ $showData->natureName }}</td>
                            <td>{{ $showData->full_name }}</td>
                            <td>

                                <button type="button" style="width:40px;height:40px;" class="btn-default btn-xs btn-filter"
                                data-target="#caseRecordModal" data-toggle="modal"
                                data-caseid="{{ $showData->caseid}}"
                                data-ccn="{{ $showData->ccn}}"
                                data-docketnumber="{{ $showData->docketnumber}}"
                                data-acmo="{{ $showData->acmo}}"
                                data-complainantname="{{ $showData->complainantname}}"
                                data-status="{{ $showData->status}}"
                                data-dateassigned="{{ $showData->dateassigned}}"
                                data-nature_name="{{ $showData->natureName}}"
                                data-date_terminated="{{ $showData->dateTerminated}}"
                                data-full_name="{{ $showData->full_name}}"
                                data-suspect_name="{{ $showData->suspectName}}"
                                >
                                    <span style="color:#0460f4;" class="fas fa-edit"></span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>CAR Case Number</th>
                        <th>Complainant</th>
                        <th>Subject</th>
                        <th>Case Nature</th>
                        <th>Agent</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

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

     <!-- Case Record Modal-->
  <div class="modal fade" id="caseRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Update Case details!</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
                    <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                <form action="/ccnUpdate" method="POST">
                    {{csrf_field()}}
                  <input type="hidden" id="caseid" name="caseid" class="form-control" value=""> {{-- QUERY HERE --}}
                  @include('encoder.modalForm')
                  <div class="form-group">
                      <center>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </center>
                  </div>
                </form>
              </div>
        </div>
      </div>
  </div>

        <!-- Validation for inputs -->
        <script>
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
        </script>

    <!-- Custom scripts for all pages -->
    <script src="bower_components/js/sb-admin.min.js"></script>
    <script src="bower_components/js/demo/datatables-demo.js"></script>
    <script src="bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!--THIS IS A COMMENT, BELOW ARE COMMENTS AND IT CANNOT RUN
      Bootstrap core JavaScript
    <script src="bower_components/vendor/jquery/jquery.min.js"></script>
     Core plugin JavaScript
    <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>
     Page level plugin JavaScript-->
    <script src="bower_components/vendor/datatables/jquery.dataTables.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.bootstrap4.js"></script>


    <script>
        $('#caseRecordModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var caseid = button.data('caseid')
            var docketnumber = button.data('docketnumber')
            var acmo = button.data('acmo')
            var complainantname = button.data('complainantname')
            var status = button.data('status')
            var dateassigned = button.data('dateassigned')
            var natureName = button.data('nature_name')
            var dateTerminated = button.data('date_terminated')
            var full_name = button.data('full_name')
            var suspectName = button.data('suspect_name')
            var ccn = button.data('ccn')

            var modal = $(this)
            modal.find('.modal-body #caseid').val(caseid)
            modal.find('.modal-body #docketnumber').val(docketnumber)
            modal.find('.modal-body #acmo').val(acmo)
            modal.find('.modal-body #complainantname').val(complainantname)
            modal.find('.modal-body #status').val(status)
            modal.find('.modal-body #dateassigned').val(dateassigned)
            modal.find('.modal-body #nameOfNature').val(natureName)
            modal.find('.modal-body #dateTerminated').val(dateTerminated)
            modal.find('.modal-body #full_name').val(full_name)
            modal.find('.modal-body #suspectName').val(suspectName)
            modal.find('.modal-body #ccn').val(ccn)
          })
    </script>
    <!-- Demo scripts for this page-->
    <script src="bower_components/js/demo/datatables-demo.js"></script>
    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#dataTable tfoot th').each( function (i) {
                var title = $('#dataTable thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="inputTable" placeholder="'+title+'" data-index="'+i+'" />' );
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
            $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
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
