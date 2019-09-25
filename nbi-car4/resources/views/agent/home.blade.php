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
   
      <script src="bower_components/js/canvasjs.min.js"></script>
      <style>
            th {
                font-size:15px;
            }
            td {
                font-size:12px;
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
            ul {
                list-style: none;
                padding-left: 0;
            }​
      </style>
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="/agentHome">NBI-CAR</a>

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
        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
            {{ Auth::user()->username }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/agentProfile">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/agentHome">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/agentCase">
            <i class="fas fa-fw fa-bullseye"></i>
            <span>Assigned Case</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid" style="padding-top:3%;padding-bottom:2%;">
          <!-- DataTables Example -->
          <a class="btn btn-primary" style="float: left" href="/agentSearch">Search for suspects <i class="fa fa-search"></i></a>
          <br>
          <br>
          <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Search Cases
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
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
              <div class="table-responsive">
                <table id="dataTable" class="table table-striped  table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>CAR Case Number</th>
                        <th>CCN</th>
                        <th>ACMO</th>
                        <th>Complainant</th>
                        <th>Case Nature</th>
                        <th>Date Assigned</th>
                        <th>Date Terminated</th>
                        <th>Status</th>
                        <th>Agent</th>
                        <th>Details</th>
                    </tr>
                  </thead>
                  <thead class="filter_header">
                    <tr>
                        <td>CAR Case Number</td>
                        <td>CCN</td>
                        <td>ACMO</td>
                        <td>Complainant</td>
                        <td>Case Nature</td>
                        <td>Date Assigned</td>
                        <td>Date Terminated</td>
                        <td>Status</td>
                        <td>Agent</td>
                        <td>Details</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($showData as $showData)
                        <tr>
                            <td>@if ($showData->docketnumber === '' or $showData->docketnumber === null)
                                <i> </i>
                              @else
                                NBI-CAR-{{ $showData->docketnumber }}
                              @endif
                            </td>
                            <td>
                               @if ($showData->ccn === '' or $showData->ccn === null)
                                <i> </i>
                              @else
                                NBI-CCN-{{ $showData->ccn }}
                              @endif
                            </td>
                            <td>{{ $showData->acmo }}</td>
                           <td>
                              @if ( $showData->complainant_organization === '' or $showData->complainant_organization === null )
                                {{ $showData->complainantname }}
                              @else
                                {{ $showData->complainant_organization }} represented by {{ $showData->complainantname }}
                                @endif
                            </td>
                            <td>{{ $showData->natureName }}</td>
                            <td>{{ $showData->dateassigned }}</td>
                            <td>
                              @if ($showData->dateTerminated === '0000-00-00' or $showData->dateTerminated === null)
                                <i> </i>
                              @else
                                {{ $showData->dateTerminated }}
                              @endif
                            </td>
                            <td>{{ $showData->stat }}</td>
                            <td>{{ $showData->full_name }}</td>
                            <td> <div>
                                      
                                        <a href="{{ route('getCaseData',[$showData->caseid]) }}">
                                        <button class="btn btn-default btn-xs btn-filter"><span style="color:#0460f4;" class="fas fa-plus-circle"> </span></button></a>
                                  </div>
                            </td>
                        </tr>

                        
                        @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>CAR Case Number</th>
                        <th>CCN</th>
                        <th>ACMO</th>
                        <th>Complainant</th>
                        <th>Case Nature</th>
                        <th>Date Assigned</th>
                        <th>Date Terminated</th>
                        <th>Status</th>
                        <th>Agent</th>
                        <th>Details</th>
                    </tr>
                  </tfoot>
                  <tfoot class="filter_footer">
                    <tr>
                        <td>CAR Case Number</td>
                        <td>CCN</td>
                        <td>ACMO</td>
                        <td>Complainant</td>
                        <td>Case Nature</td>
                        <td>Date Assigned</td>
                        <td>Date Terminated</td>
                        <td>Status</td>
                        <td>Agent</td>
                        <td>Details</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
           <div class="card-footer small text-muted">Last updated on
                  @foreach($latestUpdate as $latestUpdate)
                    {{ ($latestUpdate->recent) }}
                    @endforeach</div> 
        </div>
          </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="bower_components/vendor/jquery/jquery.min.js"></script>
    <script src="bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="bower_components/vendor/datatables/jquery.dataTables.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="bower_components/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="bower_components/js/demo/datatables-demo.js"></script>

    <script>
     $(document).ready(function() {
    // Setup - add a text input to each header cell
    $('#dataTable .filter_header td').each( function () {
        var title = $('#dataTable thead td').eq( $(this).index() ).text();
      if (title != 'Details') {
        $(this).html( '<input type="text" placeholder="Search" />' );
      }
    } );
 
    // DataTable
    var table = $('#dataTable').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filter_header td')[colIdx] ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
    </script>
    <script>
     $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#dataTable .filter_footer td').each( function () {
        var title = $('#dataTable tfoot td').eq( $(this).index() ).text();
      if (title != 'Details') {
        $(this).html( '<input type="text" placeholder="Search" />' );
      }
    } );
 
    // DataTable
    var table = $('#dataTable').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filter_footer td')[colIdx] ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
} );
    </script>
    

  </body>
@endguest
</html>
