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

        <div class="container-fluid" style="padding-bottom:3%; padding-top:2%;">
            <div class="card card-register mx-auto" style="width:50%;">
                <div class="card-header">Personal Information</div>
                <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <p style="text-align:center;">
                            Note: <b>SPACES</b> is not recognized as password.
                        </p><hr>
                    <div class="form-group">
                        <div class="form-row">
                        <div class="col-md-6">
                            <label for="firstName">First name</label>
                            <div class="">
                            <input type="text" id="firstName" class="form-control" value="{{ Auth::user()->firstName }}" disabled> {{-- QUERY HERE --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName">Last name</label>
                            <div class="">
                            <input type="text" id="lastName" class="form-control" value="{{ Auth::user()->lastName }}" disabled> {{-- QUERY HERE --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                        <div class="col-md-6">
                            <label for="userName">Username</label>
                            <div class="">
                            <input type="text" id="userName" class="form-control" value="{{ Auth::user()->username }}" disabled> {{-- QUERY HERE --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="role">Role</label>
                            <div class="">
                            <input type="text" id="role" class="form-control" value="{{ Auth::user()->role }}" disabled> {{-- QUERY HERE --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <div class="">
                            <input type="text" id="status" class="form-control" value="{{ Auth::user()->userStatus }}" disabled> {{-- QUERY HERE --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                        <div class="col-md-6">

                        </div>
                        </div>
                    </div>
<form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password"><b>Password</b></label>
                            </div>
                        </div>
                    </div>
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                            <input type="password"  minlength="8" maxlength="16" name="current-password" id="current-password" class="form-control" required="required" autofocus="autofocus">
                                            <label for="current-password">Old Password</label>

                                            @if ($errors->has('current-password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('current-password') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" minlength="8" maxlength="16" name="new-password" id="new-password" class="form-control" required="required">
                                            <label for="new-password">New Password (8-16 characters)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" maxlength="16" name="new-password_confirmation" id="new-password-confirm" class="form-control" required="required">
                                            <label for="new-password-confirm">Confirm Password</label>
                                    </div>

                                </div>
                            </div>
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                <strong style="color:red;">{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <center>
                                <button class="btn btn-primary btn-block col-md-3" type="submit" value="submit">Save</button>
                            </center>
                        </div>
</form>
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
          <div class="modal-header" >
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" >Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer" >
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
        function checkPasswordMatch() {
                var password = $("#newPassword").val();
                var confirmPassword = $("#confirmPassword").val();

                if (password != confirmPassword)
                    $("#divCheckPasswordMatch").html("Passwords do not match!").css('color','red');
                else
                    $("#divCheckPasswordMatch").html("Passwords match.").css('color','green');
            }
    </script>

  </body>
@endguest
</html>
