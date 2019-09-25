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
                    <form action="/agentSearchResult" method="POST">
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
                                        <button class="btn btn-primary btn-block col-md-2" type="submit">Search</button>
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
                                        <a href="/recordDetails/{{ $showData->caseID }}" class="btn-default btn-xs btn-filter">
                                            <span style="color:#008000;font-weight:bold;" class="">View</span>
                                        </a>
                                    </td>

                              </tr>
                            @endforeach
                            </tbody>
                            {{--
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
                             --}}
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
