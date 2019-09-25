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
    <script src="bower_components/datepicker/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bower_components/datepicker/jquery-ui.css">
    <script src="bower_components/datepicker/jquery-1.11.1.min.js"></script>
    <script src="bower_components/datepicker/jquery-ui.js"></script>
    <!--DATE PICKER2-->
    <link rel="stylesheet" href="bower_components/datepicker/jquery-ui1.css">
    <script src="bower_components/datepicker/jquery-ui1.js"></script>

    <!-- JS Datepicker -->
    <script src="bower_components/datepicker/date.js"></script>
{{--
    <!-- Add Fields
    <script src="bower_components/datepicker/addFields.js"></script>
    -->
    <!-- EXTRA CSS
    <link href="bower_components/datepicker/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    -->
--}}
    <style>
            .input-group:not(:first-of-type) { margin-top: 10px; }
            input::placeholder {
                font-style: italic;
                font-size: 14px;
            }
            textarea::placeholder{
                font-style: italic;
            }
            #buttonMe {
                float:right;
            }

            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
            label {
                font-size: 14px;
            }
            p {
                font-size: 16px;
            }

    </style>
    {{--
    <script>
        /**
        *$(document).ready(function() {
        *    $('#complainant').change(function() {
        *    $('#victimNameA').val($('#complainant').val());
        *    });
        *});
        *$(document).ready(function() {
        *    $('#complainantAddress').change(function() {
        *    $('#victimAddressA').val($('#complainantAddress').val());
        *    });
        *});
        *$(document).ready(function() {
        *    $('#complainantTelNumber').change(function() {
        *    $('#victimTelNumberA').val($('#complainantTelNumber').val());
        *    });
        *});
        */
    </script>
     --}}

 <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
          }
 </script>
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
        <li class="nav-item">
            <a class="nav-link" href="/encoderCCN"> <!--LINK HERE -->
              <i class="fas fa-fw fa-paste"></i>
              <span>Update case details</span></a>
          </li>
        <li class="nav-item active">
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
            <form action="/validateData" method="POST">
                {{ csrf_field() }}
                <div class="container-fluid" style="width:70%;height:70%;" id="myDIV">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 style="text-align:center;">Check if docketnumber, ccn, acmo is encoded
                                <a href="#" onclick="myFunction()" data-dismiss="alert" aria-label="close" class="close">&times;</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="caseNumber">NBI-CAR Case Number</label>
                                        <div class="input-group mb-2">
                                            <input type="text" id="" name="" class="form-control col-md-5" value="NBI-CAR-" readonly>
                                            <input type="text" id="validateDocketnumber" name="validateDocketnumber" value="{{ old('validateDocketnumber') }}" class="form-control" placeholder="I-00-0000" maxlength="9" pattern="^\w{1}-\d{2}-\d{4}$" onkeypress='validate(event)' onkeydown="validateDocketnumber()" title="Follow the following format. e.g. I-10-001" autocomplete="off"> {{-- QUERY HERE --}}
                                        </div>
                                        <div id="status"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ccn">CCN</label>
                                        <div class="input-group mb-2">
                                            <input type="text" id="" name="" class="form-control col-md-5" value="NBI-CCN-" readonly>
                                            <input type="text" id="validateCcn" name="validateCcn" class="ccNumber form-control" placeholder="C-00-0000000000" maxlength="10" pattern="^\w{1}-\d{2}-\d{10}$" title="Follow the following format. e.g. C-10-0000000001" onkeypress='validateCCN(event)' autocomplete="off"> {{-- QUERY HERE --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ccn">ACMO No.</label>
                                        <div class="input-group mb-2">
                                            <input type="text" id="validateAcmo" name="validateAcmo" placeholder="00-C-0000000000" title="Follow the following format. e.g. 10-C-0000000001" maxlength="15" pattern="^\d{2}-\w{1}-\d{10}$" class="form-control" value="" onkeypress='validateACMO(event)' autocomplete="off"> {{-- QUERY HERE --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center> <button class="btn btn-primary btn-block col-md-3" type="submit" id="submit" onclick="myFunction()">CHECK</button> </center>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <form method="POST" action="/encoderAddComplaintSheet">
                {{ csrf_field() }}
              <div class="container-fluid" style="padding-bottom:3%; padding-top:2%;">
                <div class="card mb-3" style="width:100%%;">
                  <center><div class="card-header"><h4>Complaint Sheet</div></center>
                    <div class="card-body">
                            <p style="font-size:20px;"> <strong>Note: </strong> Fields with &#40; * &#41; is required. </p>
                            <br>
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
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div> <!-- end .flash-message -->
                        <div class="form-group">
                          <div class="form-row">
                              <div class="col-md-4">
                                  <label for="caseNumber">NBI-CAR Case Number &#40; * &#41; </label>
                                  <div class="input-group mb-2">
                                      <input type="text" id="" name="" class="form-control col-md-5" value="NBI-CAR-" readonly>
                                      <input type="text" id="docketnumber" onkeydown="validateDocketnumber()" name="docketnumber" class="form-control" value="{{ old('docketnumber') }}" placeholder="I-00-0000" maxlength="9" pattern="^\w{1}-\d{2}-\d{4}$" onkeypress='validate(event)' title="Follow the following format. e.g. I-10-001" autocomplete="off" required> {{-- QUERY HERE --}}
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <label for="ccn">CCN</label>
                                  <div class="input-group mb-2">
                                      <input type="text" id="" name="" class="form-control col-md-5" value="NBI-CCN-" readonly>
                                      <input type="text" id="ccn" onkeydown="validateDocketnumber()" name= "ccn" class="ccNumber form-control" value="{{ old('ccn') }}" placeholder="C-00-0000000000" maxlength="15" pattern="^\w{1}-\d{2}-\d{10}$" title="Follow the following format. e.g. C-10-0000000001" onkeypress='validateCCN(event)' autocomplete="off"> {{-- QUERY HERE --}}
                                  </div>
                              </div>
                              <div class="col-md-4">
                                    <label for="ccn">ACMO No.</label>
                                    <div class="input-group mb-2">
                                        <input type="text" id="acmo" onkeydown="validateDocketnumber()" placeholder="00-C-0000000000" value="{{ old('acmo') }}" title="Follow the following format. e.g. 10-C-0000000001" maxlength="15" pattern="^\d{2}-\w{1}-\d{10}$" name= "acmo" class="form-control" value="" onkeypress='validateACMO(event)' autocomplete="off"> {{-- QUERY HERE --}}
                                    </div>
                                </div>
                          </div>
                        </div>
                      <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="agent">Investigator &#40; * &#41; </label>
                                <div class="fld_wrap" id="fld2">
                                    <div class="input-group">
                                            <select name="fld_val2[]" id="fld_val2"  class="form-control" required>
                                                <option value=""></option>
                                                @foreach($agent as $agent)
                                                <option value="{{ $agent->userid }}">{{ $agent->firstName }} {{ $agent->lastName }}</option>@endforeach
                                            </select>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-success btn-add add_button2" fldnum="2" type="button">
                                                    <span class="fas">+</span>
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="status">Status &#40; * &#41; </label>
                                <div class="input-group">
                                    <select name="status" class="form-control" required>
                                        @foreach($status as $status)
                                            <option value="{{ $status->statusid }}">{{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="dateAssigned">Date Assigned &#40; * &#41; </label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="btn btn-secondary">
                                            <i class="fas fa-fw fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text" id="datepicker" name= "dateAssigned" value="{{ old('dateAssigned') }}"  class="form-control" value="" placeholder="Choose" autocomplete="off" required> {{-- QUERY HERE --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{-- Uncomment this portion if ready to deploy
                                <label for="dateTerminated">Date Terminate</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="btn btn-secondary">
                                            <i class="fas fa-fw fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="text" id="datepickers" name="dateTerminated"  class="form-control" value="{{ old('dateTerminatedc') }}" placeholder="Choose" autocomplete="off">
                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p style="font-weight:bold;">1. Complainant </p>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="suspectName">Name &#40; * &#41; </label>
                                            <div class="">
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." id="complainant" name="complainant" value="{{ old('complainant') }}"  class="form-control" autocomplete="off" minlength="2" maxlength="100" required/>
                                                {{-- <input type="text" id="complainant" name="complainant" value="{{ old('complainant') }}"  class="form-control" onkeypress='validateComplainant(event)' autocomplete="off" minlength="5" maxlength="30" required/> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="suspectName">Organization (Blank if none)</label>
                                            <div class="">
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." id="complainantOrganization" name="complainantOrganization" value="{{ old('complainantOrganization') }}"  class="form-control" autocomplete="off" minlength="2" maxlength="100" placeholder=""/>
                                                {{-- <input type="text" id="complainant" name="complainant" value="{{ old('complainant') }}"  class="form-control" onkeypress='validateComplainant(event)' autocomplete="off" minlength="5" maxlength="30" required/> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Address &#40; * &#41; </label>
                                <div class="">
                                    <input type="text" pattern=".*\S+.*" required title="White-spaces is not accepted. Leave it blank if no information will be encoded." id="complainantAddress" name="complainantAddress" value="{{ old('complainantAddress') }}"  class="form-control" autocomplete="off" minlength="5" maxlength="255" />  {{-- QUERY HERE --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Telephone Number &#40; * &#41; </label>
                                <div class="">
                                    <input type="text" pattern=".*\S+.*" required title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" id="complainantTelNumber" name="complainantTelNumber" value="{{ old('complainantTelNumber') }}"  class="form-control" autocomplete="off" minlength="5" maxlength="15" />  {{-- QUERY HERE --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p style="font-weight:bold;">2. Persons Complained Against or Suspects</p>
                        <div class="input-group-prepend" style="float:right;">
                            <button class="btn btn-success btn-add add_button3" fldnum="3" type="button">
                                <span class="fas">+</span>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="control-group">
                                <div class="fld_wrap" id="fld3">
                                    <div class="input-group">
                                        <div class="col-md-3">
                                            <input type="text" style="background-color:#c9c9bd;" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." class="form-control" name="suspectNameA[]" placeholder="Name ( * )" autocomplete="off" minlength="2" maxlength="100" required>
                                            <br>
                                            <select id="displaySexA"  name="suspectSexA[]" class="form-control" required>
                                                <option value=" " style="font-style:italic;">Sex</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <br>
                                            <div class="form-group">
                                                <label for="">..</label>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <input type="text" id="" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" onkeypress="validateColor(event)" name="suspectHairColorA[]" placeholder="Hair Color" autocomplete="off" minlength="1" maxlength="70">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="displayAddress" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAddressA[]" placeholder="Address" autocomplete="off" minlength="5" maxlength="255">
                                            <br>
                                            <select id="displayCivilStatus"  name="suspectCivilStatusA[]" class="form-control" required>
                                                <option value=" " style="font-style:italic;">Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Deceased">Deceased</option>
                                            </select>
                                            <br>
                                            <div class="form-group">
                                                <label for="">Weight Range (kg)</label>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                            <input type="number" max="700" min="15" id="suspectWeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectWeightA[]" placeholder="Weight" autocomplete="off">
                                                        {{-- <input type="text" id="suspectWeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectWeightA[]" placeholder="Weight" autocomplete="off" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="5"> --}}
                                                    </div>
                                                    <div class="col-md-6">
                                                            <input type="number" max="700" min="15" id="suspectWeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectWeightTwo[]" placeholder="Weight" autocomplete="off">
                                                        {{-- <input type="text" id="suspectWeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectWeightTwo[]" placeholder="Weight" autocomplete="off" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="5"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="displayTel" pattern=".*\S+.*" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" name= "suspectTelNumberA[]" autocomplete="off" placeholder="Telephone Number" class="ccNumber form-control" value="" autocomplete="off" minlength="5" maxlength="15">
                                            <br>
                                            <input type="text" id="" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" onkeypress="validateColor(event)" name="suspectEyeColorA[]" placeholder="Eye Color" autocomplete="off" minlength="1" maxlength="60">
                                            <br>
                                            <div class="form-group">
                                                <label for="">Age Range</label>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                            <input type="number" max="150" min="9" id="displayAge" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeA[]" placeholder="Age" autocomplete="off">
                                                        {{-- <input type="text" id="displayAge" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeA[]" placeholder="Age" onkeypress='validateAge(event)' autocomplete="off" minlength="1" maxlength="3"> --}}
                                                    </div>
                                                    <div class="col-md-6">
                                                            <input type="number" max="150" min="9" id="suspectAgeTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeTwo[]" placeholder="Age" autocomplete="off">
                                                        {{-- <input type="text" id="suspectAgeTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeTwo[]" placeholder="Age" onkeypress='validateAge(event)' autocomplete="off" minlength="1" maxlength="3"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="displayOccupation" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectOccupationA[]" placeholder="Occupation" autocomplete="off" minlength="4" maxlength="60">
                                            <br>
                                            <input type="text" id="" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectSkinToneA[]" onkeypress="validateColor(event)" placeholder="Skin tone" autocomplete="off" minlength="1" maxlength="70">
                                            <br>
                                            <div class="form-group">
                                                <label for="">Height Range (cm)</label>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                            <input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightOne" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectHeightA[]" placeholder="Height" autocomplete="off">
                                                        {{-- <input type="text" id="suspectHeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectHeightA[]" placeholder="Height" autocomplete="off" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="5"> --}}
                                                    </div>
                                                    <div class="col-md-6">
                                                            <input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightTwo" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectHeightTwo[]" placeholder="Height" autocomplete="off">
                                                        {{-- <input type="text" id="suspectHeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectHeightTwo[]" placeholder="Height" autocomplete="off" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="5"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p style="font-weight:bold;">3. Nature of act complained &#40; * &#41; </p>
                    <section>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <div class="fld_wrap" id="fld1">
                                            <div class="input-group">
                                                <select  name="fld_val1[]" id="fld_val1" class="form-control" required>
                                                    <option value=""></option>
                                                    @foreach($nature as $nature)
                                                        <option value="{{ $nature->natureid }}">{{ $nature->nature }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-success btn-add add_button1" fldnum="1" type="button">
                                                        <span class="fas">+</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">4. Where and when committed</p>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="whereCommitted">Place Committed</label>
                                    <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="whereCommitted" id="whereCommitted" value="{{ old('whereCommitted') }}" class="form-control" minlength="3" maxlength="100" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label for="whenCommitted">When Committed</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="btn btn-secondary">
                                                <i class="fas fa-fw fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text"  name="whenCommitted" id="whenCommitted" class="form-control" value="{{ old('whenCommitted') }}" placeholder=""  autocomplete="off"> {{-- QUERY HERE --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <hr>
                    <div class="form-group">
                        <p style="font-weight:bold;">5. Victim/s If any </p>
                        <div class="form-row">
                            <div class="control-group">
                                <div class="fld_wrap" id="fld4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-success btn-add add_button4" fldnum="4" type="button">
                                                <span class="fas">+</span>
                                            </button>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="col-md-3">
                                            <input type="text" id="victimNameA" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." class="form-control"  name="victimNameA[]" placeholder="Name" autocomplete="off" minlength="2" maxlength="100">
                                            {{-- <input type="text" class="form-control" name="victimNameA[]" placeholder="Name" autocomplete="off" minlength="5" maxlength="40" required> --}}
                                            <input type="text" id="victimAgeA" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimAgeA[]" placeholder="Age" onkeypress='validateDate(event)' autocomplete="off" minlength="1" maxlength="3">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="victimAddressA" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control"  name="victimAddressA[]" placeholder="Address" autocomplete="off" minlength="5" maxlength="255">
                                            <select  name="victimCivilStatusA[]" id="victimStatusA" class="form-control">
                                                <option value=" " style="font-style:italic;">Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Deceased">Deceased</option>
                                            </select>
                                            {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimCivilStatusA[]" placeholder="Civil Status" autocomplete="off" minlength="5" maxlength="20"> --}}
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" id="victimTelNumberA" pattern=".*\S+.*" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)"  name= "victimTelNumberA[]" autocomplete="off" placeholder="Telephone Number" class="ccNumber form-control" value="" autocomplete="off" minlength="5" maxlength="15">
                                            <input type="text" id="victimOccupationA" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimOccupationA[]" placeholder="Occupation" autocomplete="off" minlength="4" maxlength="60">
                                        </div>
                                        <select  name="victimSexA[]" id="victimSexA" class="form-control">
                                            <option value=" " style="font-style:italic;">Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                            {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimSexA[]" placeholder="sex" autocomplete="off" minlength="4" maxlength="6"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">6. Narration of Facts</p>
                            <textarea name="narrationOfFacts" placeholder="Leave this portion blank if no information will be encoded." id="narrationOfFacts" style="width:100%;font-size:15px;resize:none;" rows="3" autocomplete="off">{{ Request::old('narrationOfFacts') }}</textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what people agency?</p>
                            <textarea name="hasTheMatter" placeholder="Leave this portion blank if no information will be encoded." id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="3" autocomplete="off">{{ Request::old('hasTheMatter') }}</textarea>
                            <br>
                            <p style="font-weight:bold;">Status of investigation, If any</p>
                            <textarea name="statusOfInvestigation"  placeholder="Leave this portion blank if no information will be encoded." id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="3" autocomplete="off">{{ Request::old('statusOfInvestigation') }}</textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where?</p>
                            <textarea name="isTheMatterComplained" placeholder="Leave this portion blank if no information will be encoded." id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="3" autocomplete="off">{{ Request::old('isTheMatterComplained') }}</textarea>
                        </div>
                    </section>
                    <br>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI?</p>
                            <textarea name="whatConsidirations"  placeholder="Leave this portion blank if no information will be encoded." id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="3" autocomplete="off">{{ Request::old('whatConsidirations') }}</textarea>
                        </div>
                    </section>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="">
                                    <input type="hidden" id="description" name="description" class="form-control" value="Encoder add new with docketnumber = ">
                                    <input type="hidden" id="action" name="action" class="form-control" value="Add">
                                    <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <center> <button class="btn btn-primary btn-block col-md-3" type="submit" id="submit" onclick="validateDocketnumber();validateSeven();validateRangeAge();validateRangeHeight();validateRangeWeight();return validateCase();">Save</button> </center>
                    </div>
                    </div> <!--CLOSING CARD HEADER -->
                </div> <!--CLOSING CARD REGISTER -->
              </div> <!--CLOSING CONTAINER FLUID -->
            </form>
        </div>
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
                    <span>Copyright © eCaseRecord-NBI 2018-2019</span>
            </div>
          </div>
        </footer>

      </div><!-- /.content-wrapper -->
    </div><!-- /#wrapper -->


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
          <div class="modal-body" >Select "Logout" below if you are ready to end your current session.</div>
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
    <script>
            $(document).ready(function(){
                $('.add_button2').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML = '<div class="input-group"><select name="fld_val2[]" id="fld_val2"  class="form-control"><option value=""></option>@foreach($agent2 as $agent2)<option value="{{ $agent2->userid }}">{{ $agent2->firstName }} {{ $agent2->lastName }}</option>@endforeach</select><div class="input-group-prepend"><button class="btn btn-danger btn-add add_button2 remove_button" fldnum="2" type="button"><span class="fas">x</span></button></div>';
                    $("#fld2").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
            $(document).ready(function(){
                $('.add_button1').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML = '<div class="input-group"><select  name="fld_val1[]" id="fld_val1" class="form-control" required><option value=""></option>@foreach($nature2 as $nature2)<option value="{{ $nature2->natureid }}">{{ $nature2->nature }}</option>@endforeach</select><div class="input-group-prepend"><button class="btn btn-danger btn-add add_button1 remove_button" fldnum="1" type="button"><span class="fas">x</span></button></div>';
                    $("#fld1").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
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
        function validateColor(evt) {
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
            var regex = /[0-9,I,-]/;
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
        function validateAge(evt) {
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
        function validateWeightAndHeight(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9,.]/;
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
        function validateTelephone(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9,+,-]/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
    <script>
            $(document).ready(function(){
                $('.add_button3').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML =
                            '<div class="input-group">'+
                                '<div class="col-md-3">'+
                                        '<input type="text" style="background-color:#c9c9bd;"  title="White-spaces is not accepted. Name is required." class="form-control" name="suspectNameA[]" placeholder="Name ( * )" autocomplete="off" minlength="2" maxlength="100" required>'+
                                        '<br>'+
                                        '<select id="displaySexA"  name="suspectSexA[]" class="form-control" required>'+
                                            '<option value=" " style="font-style:italic;">Sex</option>'+
                                            '<option value="Male">Male</option>'+
                                            '<option value="Female">Female</option>'+
                                        '</select>'+
                                        '<br>'+
                                        '<div class="form-group">'+
                                            '<label for="">..</label>'+
                                            '<div class="form-row">'+
                                                '<div class="col-md-12">'+
                                                    '<input type="text" id=""  title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" onkeypress="validateColor(event)" name="suspectHairColorA[]" placeholder="Hair Color" autocomplete="off" minlength="1" maxlength="70">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                        '<input type="text" id="displayAddress"  title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAddressA[]" placeholder="Address" autocomplete="off" minlength="5" maxlength="255">'+
                                        '<br>'+
                                        '<select id="displayCivilStatus"  name="suspectCivilStatusA[]" class="form-control" required>'+
                                            '<option value=" " style="font-style:italic;">Civil Status</option>'+
                                            '<option value="Single">Single</option>'+
                                            '<option value="Married">Married</option>'+
                                            '<option value="Widowed">Widowed</option>'+
                                            '<option value="Divorced">Divorced</option>'+
                                            '<option value="Separated">Separated</option>'+
                                            '<option value="Deceased">Deceased</option>'+
                                        '</select>'+
                                        '<br>'+
                                        '<div class="form-group">'+
                                            '<label for="">Weight Range (kg)</label>'+
                                            '<div class="form-row">'+
                                                '<div class="col-md-6">'+
                                                    '<input type="number" max="700" min="15" id="suspectWeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectWeightA[]" placeholder="Weight" autocomplete="off">'+
                                                '</div>'+
                                                '<div class="col-md-6">'+
                                                    '<input type="number" max="700" min="15" id="suspectWeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectWeightTwo[]" placeholder="Weight" autocomplete="off">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<input type="text" id="displayTel"  title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" name= "suspectTelNumberA[]" autocomplete="off" placeholder="Telephone Number" class="ccNumber form-control" value="" autocomplete="off" minlength="5" maxlength="15">'+
                                    '<br>'+
                                    '<input type="text" id=""  title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" onkeypress="validateColor(event)" name="suspectEyeColorA[]" placeholder="Eye Color" autocomplete="off" minlength="1" maxlength="60">'+
                                    '<br>'+
                                    '<div class="form-group">'+
                                        '<label for="">Age Range</label>'+
                                        '<div class="form-row">'+
                                            '<div class="col-md-6">'+
                                                '<input type="number" max="150" min="9" id="displayAge" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeA[]" placeholder="Age" autocomplete="off">'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<input type="number" max="150" min="9" id="suspectAgeTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeTwo[]" placeholder="Age" autocomplete="off">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<input type="text" id="displayOccupation"  title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectOccupationA[]" placeholder="Occupation" autocomplete="off" minlength="4" maxlength="60">'+
                                    '<br>'+
                                    '<input type="text" id=""  title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectSkinToneA[]" onkeypress="validateColor(event)" placeholder="Skin tone" autocomplete="off" minlength="1" maxlength="70">'+
                                    '<br>'+
                                    '<div class="form-group">'+
                                        '<label for="">Height Range (cm)</label>'+
                                        '<div class="form-row">'+
                                            '<div class="col-md-6">'+
                                                '<input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightOne" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectHeightA[]" placeholder="Height" autocomplete="off">'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightTwo" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectHeightTwo[]" placeholder="Height" autocomplete="off">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="input-group-prepend" id="buttonMe" style="position: absolute;right: 0;">'+
                                    '<button class="btn btn-danger btn-add add_button3 remove_button" fldnum="3" type="button">'+
                                        '<span class="fas">X</span>'+
                                    '</button>'+
                                '</div>'+
                            '</div>';
                    $("#fld3").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
            $(document).ready(function(){
                $('.add_button4').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML ='<div class="input-group">'+
                                    '<div class="input-group-prepend">'+
                                        '<button class="btn btn-danger btn-add add_button4 remove_button" fldnum="4" type="button">'+
                                            '<span class="fas">X</span>'+
                                        '</button>'+
                                    '</div>'+
                                    '<br>'+
                                    '<br>'+
                                    '<div class="col-md-3">'+
                                        '<input type="text" title="White-spaces is not accepted. Name is required." class="form-control" name="victimNameA[]" placeholder="Name ( * )" autocomplete="off" required minlength="5" maxlength="40">'+
                                        '<input type="text" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimAgeA[]" placeholder="Age" autocomplete="off" minlength="1" maxlength="3">'+
                                    '</div>'+
                                    '<div class="col-md-3">'+
                                        '<input type="text" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimAddressA[]" placeholder="Address" autocomplete="off" minlength="5" maxlength="255">'+
                                        '<select  name="victimCivilStatusA[]" class="form-control" required>'+
                                            '<option value=" " style="font-style:italic;">Civil Status</option>'+
                                            '<option value="Single">Single</option>'+
                                            '<option value="Married">Married</option>'+
                                            '<option value="Widowed">Widowed</option>'+
                                            '<option value="Divorced">Divorced</option>'+
                                            '<option value="Separated">Separated</option>'+
                                            '<option value="Deceased">Deceased</option>'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="col-md-3">'+
                                        '<input type="text" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" id="suspectTelNumberA" name= "victimTelNumberA[]" autocomplete="off" placeholder="Telephone Number" class="ccNumber form-control" value="" autocomplete="off" minlength="5" maxlength="15">'+
                                        '<input type="text" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimOccupationA[]" placeholder="Occupation" autocomplete="off" minlength="5" maxlength="60">'+
                                    '</div>'+
                                    '<select  name="victimSexA[]" class="form-control" required>'+
                                        '<option value=" " style="font-style:italic;">Sex</option>'+
                                        '<option value="Male">Male</option>'+
                                        '<option value="Female">Female</option>'+
                                    '</select>'+
                                '</div>';
                    $("#fld4").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
    </script>
    <script>
            whenCommitted.max = new Date().toISOString().split("T")[0];
    </script>
        {{--
        <script>
            $('input').on('change', function(){
                if($(this).val()=='Unknown'){
                    $('#suspectHeightTwo').show().focus();
                }else{
                    $('#suspectHeightTwo').val('').hide();
                }
           })
           $('input').on('change', function(){
                if($(this).val()=='Unknown'){
                    $('#suspectAgeTwo').show().focus();
                }else{
                    $('#suspectAgeTwo').val('').hide();
                }
            })
            $('input').on('change', function(){
                if($(this).val()=='Unknown'){
                    $('#suspectWeightTwo').show().focus();
                }else{
                    $('#suspectWeightTwo').val('').hide();
                }
            })
        </script>
        --}}
    <script>
        function validateSeven(){
            var statusOfInvestigation = document.getElementById('statusOfInvestigation').value;
            var hasTheMatter = document.getElementById('hasTheMatter').value;

            if(hasTheMatter == "" && statusOfInvestigation !== "" ){
                alert('Please provide a statement in number 7, you provide a the Status of investigation which is dependent in number 7.')
                return false;
            }else{
                return true;
            }
        }
    </script>
    <script>
        function validateDocketnumber(){
            var docketnumber = document.getElementById('docketnumber').value;
            var acmo = document.getElementById('acmo').value;
            var ccn = document.getElementById('ccn').value;

            var res = docketnumber.slice(5,9);
            var res2 = acmo.slice(5,16);
            var res3 = ccn.slice(5,16);

            if( res == "0000" ){
                alert('Invalid docketnumber. Docketnumber starts at 0001')
                return false;
            }else if(res2 == "0000000000"){
                alert('Invalid acmo. ACMO starts at 0000000001')
                return false;
            }else if (res3 == "0000000000"){
                alert('Invalid ccn. CCN starts at 0000000001')
                return false;
            }else{
                return true;
            }
        }
        function validateVictim(){
            var victimNameA = document.getElementById('victimNameA').value;
            var victimAgeA = document.getElementById('victimAgeA').value;
            var victimAddressA = document.getElementById('victimAddressA').value;
            var victimStatusA = document.getElementById('victimStatusA').value;
            var victimTelNumberA = document.getElementById('victimTelNumberA').value;
            var victimOccupationA = document.getElementById('victimOccupationA').value;
            var victimSexA = document.getElementById('victimSexA').value;

            if(victimNameA == "" || (victimAgeA !== "" || victimAddressA !== "" || victimStatusA !== "" || victimTelNumberA !== "" || victimOccupationA !== "" || victimSexA || !== "")){
                alert('You must provide the name of the victim. Leave all fields blank if you there is no victim.')
                return false;
            }else{
                return true;
            }
        }
        function validateRangeHeight(){
            var suspectHeightOne = document.getElementById('suspectHeightOne').value;
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
            var displayAge = document.getElementById('displayAge').value;
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
            var suspectWeightOne = document.getElementById('suspectWeightOne').value;

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

        function validateCase(){
            var acmo = document.getElementById('acmo').value;
            var ccn = document.getElementById('ccn').value;

            if((acmo == "" && ccn !== "")||(acmo !== "" && ccn == "")){
                alert('Encoding of ACMO and CCN can not be separated. ')
                return false;
            }else{
                return true;
            }
        }

    </script>
{{--
    <script>
    /*
        function validateForm() {
            var narrationOfFacts = document.getElementById("narrationOfFacts");
            var hasTheMatter = document.getElementById("hasTheMatter");
            var statusOfInvestigation = document.getElementById("statusOfInvestigation");
            var isTheMatterComplained = document.getElementById("isTheMatterComplained");
            var whatConsidirations = document.getElementById("whatConsidirations");

            if ($.trim(whatConsidirations.value) == '' || $.trim(isTheMatterComplained.value) == '' || $.trim(statusOfInvestigation.value) == '' || $.trim(hasTheMatter.value) == '' || $.trim(narrationOfFacts.value) == '' ) {
                alert("Input violation from number 6 - 9, your must provide the correct information. Spaces ONLY is not accepted.");
                return false;
            } else if($.trim(whatConsidirations.value) == null || $.trim(isTheMatterComplained.value) == null || $.trim(statusOfInvestigation.value) == null || $.trim(hasTheMatter.value) == null || $.trim(narrationOfFacts.value) == null ){
                return true;
            }else{
                return true;
            }
        }
    */
    </script>
--}}
    <!-- Custom scripts for all pages -->
    <script src="bower_components/js/sb-admin.min.js"></script>
    <script src="bower_components/js/demo/datatables-demo.js"></script>
    <script src="bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    {{--
    <!--THIS IS A COMMENT, BELOW ARE COMMENTS AND IT CANNOT RUN
    Bootstrap core JavaScript
    <script src="bower_components/vendor/jquery/jquery.min.js"></script>
    Core plugin JavaScript
    <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>
    Page level plugin JavaScript
    <script src="bower_components/vendor/datatables/jquery.dataTables.js"></script>
    <script src="bower_components/vendor/datatables/dataTables.bootstrap4.js"></script>
    Demo scripts for this page-->

    --}}



  </body>
@endguest
</html>
