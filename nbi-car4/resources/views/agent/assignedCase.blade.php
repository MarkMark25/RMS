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
        <li class="nav-item">
          <a class="nav-link" href="/agentHome">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/agentCase">
              <i class="fas fa-fw fa-bullseye"></i>
              <span>Assigned Case</span></a>
          </li>
      </ul>

      <div id="content-wrapper">
            <div class="row">
                <div class="col-xl-2 col-sm-6">
                    <h5 style="text-align:center;" name="agentName" id="agentName">
                    @foreach($agentFullName as $agentFullName)
                    {{ ($agentFullName->fname) }}
                    @endforeach
                    </h5>
                    <h6 style="text-align:center;text-decoration:underline;">Agent</h6>
                </div>
                <div class="col-xl-3 col-sm-6 mb-5 pl-5">
                    <div class="card text-dark bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                            <i class="fas fa-fw fa fa-address-book"></i>
                            </div>
                            <div class="mr-5">
                                <div>
                                    <h4 style="text-align:center;" name="pendingCount" id="pendingCount">
                                    {{ ($assignedCases) }}
                                    </h4>
                                    <h6>Assigned Cases</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-5 pl-5">
                    <div class="card text-dark bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                            <i class="fas fa-fw fa fa-cog fa-pulse" ></i>
                            </div>
                            <div class="mr-5">
                                <div>
                                    <h4 style="text-align:center;" name="pendingCount" id="pendingCount">
                                    {{ ($pendingCase) }}
                                    </h4>
                                    <h6>Ongoing Cases</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-5 pl-5">
                    <div class="card text-dark bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                            <i class="fas fa-fw fa-archive"></i>
                            </div>
                            <div class="mr-5">
                               <div>
                                   <h4 style="text-align:center;" name="successCount" id="successCount">
                                   {{($caseClosed)}}
                                    </h4>
                                   <h6>Case Closed!</h6>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container-fluid">

          <!-- Search Case -->
          <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Assigned Cases
            </div>
            <div class="card-body">
            <div class="flash-message">
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
                <table class="table table-striped  table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>CAR Case No.</th>
                      <th>Subject</th>
                      <th>Complainant</th>
                      <th>Victim</th>
                      <th>Case Nature</th>
                      <th>Date Assigned</th>
                      <th>Status</th>
                      <th>Date Terminated</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <thead class="filter_header">
                    <tr>
                      <td>CAR Case No.</td>
                      <td>Subject</td>
                      <td>Complainant</td>
                      <td>Victim</td>
                      <td>Case Nature</td>
                      <td>Date Assigned</td>
                      <td>Status</td>
                      <td>Date Terminated</td>
                      <td>Action</td>
                    </tr>
                  </thead>
                  @foreach($showData as $showData)
                    <tr>
                        <td>NBI-CAR-{{ $showData->docketNumber }}</td>
                        <td>{{ $showData->suspectName }}</td>
                        <td>
                          @if ( $showData->complainant_organization === '' or $showData->complainant_organization === null )
                            {{ $showData->complainantname }}
                          @else
                            {{ $showData->complainant_organization }} represented by {{ $showData->complainantname }}
                          @endif
                        </td>
                        <td>{{ $showData->victimName }}
                        <td>{{ $showData->natureName }}</td>
                        <td>{{ $showData->dateassigned }}</td>
                        <td>{{ $showData->stat }}</td>
                        <td>
                          @if ($showData->dateTerminated === '0000-00-00' or $showData->dateTerminated === null)
                            <i> </i>
                          @else
                          {{ $showData->dateTerminated }}
                          @endif
                          </td>
                          <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#reportsModal{{ $showData->caseid }}"><span style="font-size:smaller;">Add Report</span></button><br style="line-height:40px;" /> <a href="{{ route('getViewCase',[$showData->caseid]) }}"> <button class="btn btn-info btn-sm"><span style="font-size:smaller;">View Details</span></button></a></td>
                    </tr>
                  <!-- Reports Modal -->
      <div class="modal fade" id="reportsModal{{ $showData->caseid }}" tabindex="-1" role="dialog" aria-labelledby="reportsModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="reportsModal">Case Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <div class="modal-body">
                        <form action="/uploadfile" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="caseid" name="caseid" class="form-control" value="{{ $showData->caseid }}">
                                <input type="hidden" id="docketnum" name="docketnum" class="form-control" value="{{ $showData->docketNumber }}">
                                <input type="file" class="form-control-file" name="fileToUpload" id="inputFile" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid pdf or doc file.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
                  @endforeach
                  <tfoot>
                    <tr>
                      <th>CAR Case No.</th>
                      <th>Subject</th>
                      <th>Complainant</th>
                      <th>Victim</th>
                      <th>Case Nature</th>
                      <th>Date Assigned</th>
                      <th>Status</th>
                      <th>Date Terminated</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tfoot class="filter_footer">
                    <tr>
                      <td>CAR Case No.</td>
                      <td>Subject</td>
                      <td>Complainant</td>
                      <td>Victim</td>
                      <td>Case Nature</td>
                      <td>Date Assigned</td>
                      <td>Status</td>
                      <td>Date Terminated</td>
                      <td>Action</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
           <div class="card-footer small text-muted">Last updated on
                  @foreach($latestUpdate as $latestUpdate)
                    {{ ($latestUpdate->recent) }}
                    @endforeach</div> 
        </div>
        <!-- /.container-fluid -->


    </div>
  </div>
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
    <!-- wrapper -->

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
      if (title != 'Action') {
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
      if (title != 'Action') {
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
