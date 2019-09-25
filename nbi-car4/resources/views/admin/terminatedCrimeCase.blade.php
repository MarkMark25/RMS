<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <title>NBI-CAR</title>

    <!-- Bootstrap core CSS-->
    <link href="bower_components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="bower_components/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="bower_components/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="bower_components/vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bower_components/datepicker/jquery-ui.css">
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
            
      </style>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1 " href="/">NBI-CAR</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle">
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

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Manage Case</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a class="dropdown-item" href="/caseReport">Case Records</a>
                <a class="dropdown-item" href="/addNewCase">Add New Case</a>
                <a class="dropdown-item" href="/ComplaintSheet">Complaint Sheet</a>
                <a class="dropdown-item" href="/caseNature">Case Nature</a>
                <a class="dropdown-item" href="/caseStatus">Case Status</a>
            </div>
         </li>

        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Generate Report</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/ccnAcmoRequest">CCN Request</a> <!-- add page for case records-->
            <a class="dropdown-item" href="/terminatedCases">Transmittal</a>  <!-- add page -->
            <a class="dropdown-item" href="/terminatedCrimeCase">Terminated Crimes</a>  <!-- add page -->
            <a class="dropdown-item" href="/pendingCrimes">Pending Crimes</a>  <!-- add page -->


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
                     <a class="dropdown-item" href="/archivedNature">Case Nature</a>
                  </div>
               </li>

<br>
<br>


    </ul>


      <!-- /.container-fluid -->

      <div id="content-wrapper">

        <div class="container-fluid" style="padding-top:3%;padding-bottom:2%;">
        <h1>Terminated Crimes</h1>
          <div class="row">
                     <div class="col-md-2">
                        <form method="POST" action="{{ route('daterange.fetch_terminated') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <b><span>Year </span></b>
                           <select name="year" id="year" class="form-control">
                              <option value="" selected>Year</option>
                              <option value="2000">2000</option>
                              <option value="2001">2001</option>
                              <option value="2002">2002</option>
                              <option value="2003">2003</option>
                              <option value="2004">2004</option>
                              <option value="2005">2005</option>
                              <option value="2006">2006</option>
                              <option value="2007">2007</option>
                              <option value="2008">2008</option>
                              <option value="2009">2009</option>
                              <option value="2010">2010</option>
                              <option value="2011">2011</option>
                              <option value="2012">2012</option>
                              <option value="2013">2013</option>
                              <option value="2014">2014</option>
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
                              <option value="2028">2028</option>
                              <option value="2029">2029</option>
                              <option value="2030">2030</option>
                              <option value="2031">2031</option>
                              <option value="2032">2032</option>
                              <option value="2033">2033</option>
                              <option value="2034">2034</option>
                              <option value="2035">2035</option>
                              <option value="2036">2036</option>
                              <option value="2037">2037</option>
                              <option value="2038">2038</option>
                              <option value="2039">2039</option>
                              <option value="2040">2040</option>
                           </select>
                     </div>
                     <div class="col-md-3">
                     <b><span>Month </span></b>
                     <select name="month" id="month" class="form-control">
                     <option value="" selected>Month</option>
                     <option value="1">January</option>
                     <option value="2">February</option>
                     <option value="3">March</option>
                     <option value="4">April</option>
                     <option value="5">May</option>
                     <option value="6">June</option>
                     <option value="7">July</option>
                     <option value="8">August</option>
                     <option value="9">September</option>
                     <option value="10">October</option>
                     <option value="11">November</option>
                     <option value="12">December</option>
                     </select>
                     </div>
                     <div class="col-md-1">
                     <br>
                     <button type="submit" class="btn btn-danger float-right" name="filter" id="filter">Search</button>
                     </div>
                     <div class="col-md-1">
                     <br>
                     <button type="reset" class="btn btn-primary float-left" name="refresh" id="refresh" onClick="window.location.href='/terminatedCrimeCase'" >Refresh</button>
                     </div>
                     </form>
                  </div>
                  <br>

      <!-- DataTables Example -->
      <div class="card mb-3">
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
                 @if($cMonth == null)
                <p></p>
                @else
                <p  style="text-align:center;">TERMINATED CRIME CASES FOR <b>{{$cMonth}} {{$year}}</b></p>
                 @endif
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                        <th>No</th>
                        <th>NBI CCN No./ ACMO No.</th>
                        <th>CAR No.</th>
                        <th>Nature</th>
                        <th>Complainant/Victim</th>
                        <th>Subject/s</th>
                        <th>Date Assigned</th>
                        <th>Date Terminated</th>
                        <th>Agent-on-Case</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($showData as $keycount=>$showData)
                    <tr>
                        <td>{{ $keycount+1 }}</td>
                        <td>{{ $showData->ccnacmo }}</td>
                        <td>{{ $showData->docketnumber }}</td>
                        <td>{{ $showData->case_nature }}</td>
                        <td>
                          @if (( $showData->complainant_organization === '' or $showData->complainant_organization === null) and ($showData->vic === '' or $showData->vic === null))
                                {{ $showData->com }}

                          @elseif  ( $showData->vic === '' or $showData->vic === null )
                                {{ $showData->comOrg }} REPRESENTED BY {{ $showData->com }}

                          @elseif ($showData->complainant_organization === '' or $showData->complainant_organization === null)
                                {{ $showData->com }}, {{ $showData->vic }}

                          @else
                                {{ $showData->comOrg }} REPRESENTED BY {{ $showData->com }}, {{$showData->vic}}
                                
                          @endif
                        </td>
                        <td>{{ $showData->subject }}</td>
                        <td>@if ($showData->assigneddate === '0000-00-00' or $showData->assigneddate === null)
                            <i> </i>
                          @else
                          {{ $showData->assigneddate }}
                          @endif
                        </td>
                        <td>@if ($showData->dateTerminated === '0000-00-00' or $showData->dateTerminated === null)
                            <i> </i>
                          @else
                          {{ $showData->terminated_date }}
                          @endif
                        </td>
                        <td>{{ $showData->agentoncase }}</td>
                        <td>{{ $showData->stat }}</td>
                    </tr>
                  @endforeach
                    </tbody>
                    <tfoot>
                  <tr>
                        <th>No</th>
                        <th>NBI CCN No./ ACMO No.</th>
                        <th>CAR No.</th>
                        <th>Nature</th>
                        <th>Complainant/Victim</th>
                        <th>Subject/s</th>
                        <th>Date Assigned</th>
                        <th>Date Terminated</th>
                        <th>Agent-on-Case</th>
                        <th>Status</th>
                    </tr>
                  </tfoot>
                </table>
                {{ csrf_field()}}
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
          <div class="modal-header" style="background-color:#dd8282;">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" style="background-color:#edcbcb;">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer" style="background-color:#dd8282;">
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

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

     <!-- Datatables Report -->
    <script src="bower_components/vendor/datatables/jquery-3.3.1.js"></script>
    <script src="bower_components/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="bower_components/vendor/datatables/jszip.min.js"></script>
    <script src="bower_components/vendor/datatables/pdfmake.min.js"></script>
    <script src="bower_components/vendor/datatables/vfs_fonts.js"></script>
    <script src="bower_components/vendor/datatables/buttons.html5.min.js"></script>
    <script src="bower_components/vendor/datatables/buttons.print.min.js"></script>

    <!-- JS Datepicker -->
    <script src="bower_components/datepicker/jquery-ui.js"></script>
    <script src="bower_components/datepicker/date.js"></script>

    <script type="text/javascript">


            $(document).ready(function() {
              var year = {!! json_encode($year, JSON_HEX_TAG)!!};
              var cMonth = {!! json_encode($cMonth, JSON_HEX_TAG)!!};
              var records_displayed;
            
              $('#dataTable').DataTable( {
                drawCallback: function() {
                  var api = this.api();
                  records_displayed = api.page.info().recordsDisplay;
                },
                  dom: 'Bfrtip',
                  "language": {
                  "info": "TOTAL NUMBER OF RECEIVED AND TERMINATED CRIME CASES: _TOTAL_",
                  "infoEmpty": "TOTAL NUMBER OF RECEIVED AND TERMINATED CRIME CASES: 0",       
                },
                
                
                  buttons: [
            'copy',
            {
                extend: 'excel',
                title: null,
                filename: function(){
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; 
                var yyyy = today.getFullYear();

                if(dd<10) {
                    dd = '0'+dd
                } 

                if(mm<10) {
                    mm = '0'+mm
                } 

                today = mm + '-' + dd + '-' + yyyy;
                return 'TERMINATED CRIME CASES (' + today + ')';
            },
                 messageTop: function () {
 
                    if ( cMonth === null ) {
                        return 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR ';
                    }
                    else {
                        return 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR '  +cMonth+ ' ' +year;
                    }
                },
                messageBottom: function() {
                  return 'TOTAL NUMBER OF RECEIVED AND TERMINATED CRIME CASES: ' +records_displayed+ '                                                                                                                                                                                         RD HECTOR EDUARD M. GEOLOGO';
                },
                exportOptions: {
                    stripHtml: false,
                    format: {
                      body: function ( data, column, row ) {
                        return (row === 0) ? data.replace( /\n/g, '"&CHAR(10)&CHAR(13)&"' ) : data.replace(/(&nbsp;|amp;|<([^>]+)>)/ig, " ");;
                      }
                    }
                },
                customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                
                   $('row c[r^="B"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'NBI CCN No./ ACMO No.' ) {
                        $(this).attr( 's', '55' );
                    }
                    });

                   $('row c[r^="D"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'Nature' ) {
                        $(this).attr( 's', '55' );
                    }
                    });
                   $('row c[r^="E"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'Complainant/Victim' ) {
                        $(this).attr( 's', '55' );
                    }
                    });
                   $('row c[r^="F"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'Subject/s' ) {
                        $(this).attr( 's', '55' );
                    }
                    });
                   $('row c[r^="I"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'Agent-on-Case' ) {
                        $(this).attr( 's', '55' );
                    }
                    });
                   $('row c[r^="G"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'Date Assigned' ) {
                        $(this).attr( 's', '55' );
                    }
                    });
                   $('row c[r^="J"]', sheet).each( function () {
                    if ( $('is t', this).text() != 'Status' ) {
                        $(this).attr( 's', '55' );
                    }
                    });
                   //$('row:first c', sheet).attr('s','55');
},
                
            },
            {
                extend: 'pdf',
                download: 'open',
                filename: function(){
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; 
                var yyyy = today.getFullYear();

                if(dd<10) {
                    dd = '0'+dd
                } 

                if(mm<10) {
                    mm = '0'+mm
                } 

                today = mm + '-' + dd + '-' + yyyy;
                return 'TERMINATED CRIME CASES (' + today + ')';
            },
                orientation: 'landscape',
                messageTop: function () {
 
                    if ( cMonth === null ) {
                        return 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR ';
                    }
                    else {
                        return 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR '  +cMonth+ ' ' +year;
                    }
                },
                messageBottom: function() {
                  return 'TOTAL NUMBER OF RECEIVED AND TERMINATED CRIME CASES: ' +records_displayed+ ' \n\n RD HECTOR EDUARD M. GEOLOGO';
                },
            },
            {
                extend: 'print',
                title: '',
                customize: function(win)
            {
 
                var last = null;
                var current = null;
                var bod = [];
 
                var css = '@page { size: landscape; }',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');
 
                style.type = 'text/css';
                style.media = 'print';
 
                if (style.styleSheet)
                {
                  style.styleSheet.cssText = css;
                }
                else
                {
                  style.appendChild(win.document.createTextNode(css));
                }
 
                head.appendChild(style);
         },
                messageTop: function () {
 
                    if ( cMonth === null ) {
                        return 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR ';
                    }
                    else {
                        return 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR ' +cMonth+ ' ' +year;
                    }
                },
                messageBottom: function() {
                  return 'TOTAL NUMBER OF RECEIVED AND TERMINATED CRIME CASES: ' +records_displayed+ '                                                                                                                                                                                         RD HECTOR EDUARD M. GEOLOGO';
                },
            }
        ]
              } );
            } );
            
            
            
         </script>


  </body>
  @endguest
</html>
