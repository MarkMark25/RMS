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
    <link rel="icon"  href="{{URL::to('bower_components/image/nbi-logo.png')}}">

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
                font-size: 14px;
            }
            textarea::placeholder{
                font-style: italic;
            }
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
            input[type="text"]
            {
                font-size:15px;
            }
            label {
                font-size: 14px;
            }
            p {
                font-size: 16px;
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
                  <a class="nav-link" href="/encoderHome">
                      <i class="fas fa-fw fa-home"></i>
                      <span>Home</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/encoderCCN"> <!--LINK HERE -->
              <i class="fas fa-fw fa-paste"></i>
              <span>Update case details</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/complaintSheet"> <!--LINK HERE -->
              <i class="fas fa-fw fa-newspaper"></i>
              <span>Add Case</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/caseRecords"> <!--LINK HERE -->
            <i class="fas fa-fw"></i>
            <span>Case Records</span></a>
        </li>
        </ul>
      <div id="content-wrapper">
            <a href="/caseRecords" class="btn btn-secondary" style="margin-left:20px;">
                <i class="fas fa-backward"></i>
                <span>Back</span>
            </a>
            <form method="POST" action="{{url('/updatedCaseRecords')}}">
                {{ csrf_field() }}
              <div class="container-fluid" style="padding-bottom:3%; padding-top:2%;">
                <div class="card mb-3" style="width:100%%;">
                  <center><div class="card-header"><h4>Update case details</div></center>
                    <div class="card-body">
                        <p style="font-size:20px;"> <strong>Note: </strong> Fields with &#40; * &#41; is required. </p>
                        @foreach ($cases as $cases)
                        <input type="hidden" id="caseID" name= "caseID" class="form-control"  value="{{ $cases->caseID }}" readonly>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="ccn">CCN</label>
                                    <input type="text" id="ccn" onkeydown="validateDocketnumber()" name= "ccn" class="ccNumber form-control" value="{{ $cases->ccn }}" placeholder="C-00-0000000000" maxlength="15" pattern="^\w{1}-\d{2}-\d{10}$" title="Follow the following format. e.g. C-10-0000000001" onkeypress='validateCCN(event)' autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <label for="acmo">ACMO No.</label>
                                    <input type="text" id="acmo" onkeydown="validateDocketnumber()" name= "acmo" value="{{ $cases->acmo}}" placeholder="00-C-0000000000" title="Follow the following format. e.g. 00-C-0000000001" maxlength="15" pattern="^\d{2}-\w{1}-\d{10}$"  class="form-control" onkeypress='validateACMO(event)' autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <label for="caseNumber">Car Case Number &#40; * &#41; </label>
                                    <div class="input-group mb-2">
                                            <input type="text" id="docketnumber" onkeydown="validateDocketnumber()" name="docketnumber" class="form-control" value="{{ $cases->docketnumber }}" placeholder="I-00-0000" maxlength="9" pattern="^\w{1}-\d{2}-\d{4}$" onkeypress='validate(event)' onkeydown="validateDocketnumber()" title="Follow the following format. e.g. I-10-001" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <div class="form-row">
                                @foreach ($dateTerminated as $dateTerminated)
                                <div class="col-md-4">
                                    <label for="dateTerminated">Date Terminated</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="btn btn-secondary">
                                                <i class="fas fa-fw fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="text" id="datepickers" name="dateTerminated" class="form-control"  value="{{ $dateTerminated->dateTerminated}}">
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-4">
                                    <label for="status">Status &#40; * &#41; </label>
                                    <div class="input-group">
                                        <select name="status" id="caseStatus" class="form-control" required>
                                            @foreach($status as $status)
                                                <option value="{{ $status->statusid }}">{{ $status->status }}</option>
                                            @endforeach
                                            @foreach ($statusAll as $statusAll)
                                                <option value="{{ $statusAll->statusid }}">{{ $statusAll->status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button class="btn btn-success btn-add add_button2" fldnum="2" type="button" style="float:left;">
                                                    <span class="fas">+</span>
                                                </button>
                                                <br>
                                                <br>
                                                <div class="form-group">
                                                    @foreach ($agent as $agent)
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="fld_wrap" id="fld2">
                                                                        <div class="input-group">
                                                                            <div class="col-md-4">
                                                                                    <label for="agent">Investigator</label>
                                                                                    @if ($agent->agent_status === "Current")
                                                                                        <input type="hidden" class="form-control" name="readME" id="readME" value="{{ $agent->userid }}">
                                                                                        <input type="text" style="background-color:#adf4c5;" id="fld_val2" name= "agentName" class="form-control"  value="{{ $agent->agentName}}" readonly>
                                                                                        <input type="hidden" class="form-control" name="fld_val2[]" id="fld_val2[]" value="{{ $agent->userid }}" readonly>
                                                                                        <input type="hidden" class="form-control" name="agentCaseID[]" id="agentCaseID[]" value="{{ $agent->caseagentid }}" readonly>
                                                                                    @else
                                                                                        <input type="hidden" class="form-control" name="readME" id="readME" value="{{ $agent->userid }}">
                                                                                        <input type="text" style="background-color:#F48A81;" id="fld_val2" name= "agentName" class="form-control"  value="{{ $agent->agentName}}" readonly>
                                                                                        <input type="hidden" class="form-control" name="fld_val2[]" id="fld_val2[]" value="{{ $agent->userid }}" readonly>
                                                                                        <input type="hidden" class="form-control" name="agentCaseID[]" id="agentCaseID[]" value="{{ $agent->caseagentid }}" readonly>
                                                                                    @endif
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label for="agent">Date Assigned</label>
                                                                                @if ($agent->agent_status === "Current")
                                                                                <input type="text" id="" style="background-color:#adf4c5;" name= "dateAssigned[]" class="form-control"  value="{{ $agent->dateassigned}}" readonly>
                                                                                @else
                                                                                <input type="text" id="" style="background-color:#F48A81;" name= "dateAssigned[]" class="form-control"  value="{{ $agent->dateassigned}}" readonly>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                    <label for="agent">Agent Case Status</label>
                                                                                    @if ($agent->agent_status === "Current")
                                                                                    <select name="agentStatus[]" id="" class="form-control">
                                                                                        <option value="{{ $agent->agent_status}}" style="background-color:#adf4c5;">{{ $agent->agent_status}}</option>
                                                                                        <option value="Previous">Previous</option>
                                                                                    </select>
                                                                                    {{-- <input type="text" id="" style="background-color:red;" name= "agentStatus[]" class="form-control"  value="" readonly> --}}
                                                                                    @else
                                                                                    <select name="agentStatus[]" id="" class="form-control">
                                                                                        <option value="{{ $agent->agent_status}}" style="background-color:#F48A81;">{{ $agent->agent_status}}</option>
                                                                                        <option value="Current">Current</option>
                                                                                    </select>
                                                                                    {{-- <input type="text" id="" name= "agentStatus[]" class="form-control"  value="{{ $agent->agent_status}}" readonly> --}}
                                                                                    @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <hr>
                        <div class="form-group">
                            <p style="font-weight:bold;">1. Complainant</p>
                            <div class="form-row">
                            @foreach ($casesComplaint as $casesComplaint)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="suspectName">Name &#40; * &#41; </label>
                                                <div class="">
                                                    <input type="text" pattern=".*\S+.*" title="This field is required." id="complainant" name="complainant"  class="form-control"  value="{{ $casesComplaint->complainantname}}"/>  {{-- QUERY HERE --}}
                                                    <input type="hidden" name="" id="" class="form-control" value="{{ $casesComplaint->caseid}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="suspectName">Organization (Blank if none)</label>
                                                <div class="">
                                                    <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." id="complainantOrganization" name="complainantOrganization" value="{{ $casesComplaint->complainant_organization}}"  class="form-control" autocomplete="off" minlength="2" maxlength="100" placeholder=""/>
                                                    {{-- <input type="text" id="complainant" name="complainant" value="{{ old('complainant') }}"  class="form-control" onkeypress='validateComplainant(event)' autocomplete="off" minlength="5" maxlength="30" required/> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Address &#40; * &#41; </label>
                                    <div class="">
                                        <input type="text" pattern=".*\S+.*" required title="This field is required." id="complainantAddress" name="complainantAddress"  class="form-control"   value="{{ $casesComplaint->complainant_Address}}" minlength="5" maxlength="255"/>  {{-- QUERY HERE --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Telephone Number &#40; * &#41; </label>
                                    <div class="">
                                        <input type="text" pattern=".*\S+.*" required id="complainantTelNumber" name="complainantTelNumber"  class="form-control" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)"  value="{{ $casesComplaint->complainant_Contact_Number}}"/>  {{-- QUERY HERE --}}
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    <hr>
                        <button class="btn btn-success btn-add add_button3" fldnum="3" type="button" style="float:right;">
                            <span class="fas">+</span>
                        </button>
                        <p style="font-weight:bold;">2. Persons Complained Against or Suspects</p>
                            @foreach($suspect as $suspect)
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="fld_wrap" id="fld3">
                                        <div class="input-group">
                                            <div class="col-md-3">
                                                <label for="">Name &#40; * &#41; </label>
                                                    <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." class="form-control" id="suspectNameA" name="suspectNameA[]"  value="{{ $suspect->suspect_name }}" style="background-color:#dd8282;" required minlength="2" maxlength="100">
                                                <label for="">Civil Status</label>
                                                <select  name="suspectCivilStatusA[]" class="form-control">
                                                    <option value="{{ $suspect->suspect_Civil_Status }}">{{ $suspect->suspect_Civil_Status }}</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Separated">Separated</option>
                                                    <option value="Deceased">Deceased</option>
                                                </select>
                                                <label for="">Hair Color</label>
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectHairColorA[]" class="form-control"  value="{{ $suspect->hair_color }}" onkeypress="validateColor(event)" minlength="1" maxlength="70">
                                                <label for="">Age</label>
                                                @if ($suspect->suspect_Age2 === null)
                                                <input type="number" max="150" min="9" id="displayAge" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeA[]" value="{{ $suspect->suspect_Age }}" placeholder="Age" autocomplete="off">
                                                {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectAge" name="suspectAgeA[]"  value="{{ $suspect->suspect_Age }}" onkeypress="validateAge(event)" minlength="1" maxlenght="3"> --}}
                                                @else
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                    <input type="number" max="150" min="9" id="displayAge" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeA[]" value="{{ $suspect->suspect_Age }}" placeholder="Age" autocomplete="off">
                                                                {{-- <input type="text" id="displayAge" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectAge" name="suspectAgeA[]"  value="{{ $suspect->suspect_Age }}" onkeypress="validateAge(event)" minlength="1" maxlenght="3"> --}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                    <input type="number" max="150" min="9" id="suspectAgeTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectAgeTwo[]" value="{{ $suspect->suspect_Age2 }}" placeholder="Age" autocomplete="off">
                                                                {{-- <input type="text" id="suspectAgeTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectAge" name="suspectAgeTwo[]"  value="{{ $suspect->suspect_Age2 }}" onkeypress="validateAge(event)" minlength="1" maxlenght="3"> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Address</label>
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectAddressA" name="suspectAddressA[]"  value="{{ $suspect->suspect_Address }}" minlength="5" maxlength="255">
                                                <label for="">Status</label>
                                                @if ($suspect->status === "Guilty")
                                                <select name="statusA[]" id="" class="form-control">
                                                    <option value="{{ $suspect->status }}">{{ $suspect->status }}</option>
                                                    <option value="Innocent">Innocent</option>
                                                </select>
                                                @else
                                                <select name="statusA[]" id="" class="form-control">
                                                    <option value="{{ $suspect->status }}">{{ $suspect->status }}</option>
                                                    <option value="Guilty">Guilty</option>
                                                </select>
                                                @endif
                                                <label for="">Eye Color</label>
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="suspectEyeColorA[]"  value="{{ $suspect->eye_color }}" onkeypress="validateColor(event)" minlength="1" maxlength="70">
                                                {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectCivilStatusA" name="suspectCivilStatusA[]"  value="{{ $suspect->suspect_Civil_Status }}" minlength="5" maxlength="20"> --}}
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Telephone Number</label>
                                                <input type="text" pattern=".*\S+.*" id="suspectTelNumberA" class="form-control" name= "suspectTelNumberA[]"  value="{{ $suspect->suspect_Contact_Number }}" minlength="5" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" maxlength="15">
                                                <label for="">Occupation</label>
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectOccupationA" name="suspectOccupationA[]"  value="{{ $suspect->suspect_Occupation }}" minlength="4" maxlength="60">
                                                <label for="">Weight (kg)</label>
                                                @if ($suspect->weight2 === null)
                                                <input type="number" max="700" min="15" id="suspectWeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" value="{{ $suspect->weight }}" name="suspectWeightA[]" placeholder="Weight" autocomplete="off">
                                                {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectWeightA[]" class="form-control"  value="{{ $suspect->weight }}" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="10"> --}}

                                                @else
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                    <input type="number" max="700" min="15" id="suspectWeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" value="{{ $suspect->weight }}" name="suspectWeightA[]" placeholder="Weight" autocomplete="off">
                                                                {{-- <input type="text" id="suspectWeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectWeightA[]" class="form-control"  value="{{ $suspect->weight }}" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="10"> --}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                    <input type="number" max="700" min="15" id="suspectWeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" value="{{ $suspect->weight2 }}" name="suspectWeightTwo[]" placeholder="Weight" autocomplete="off">
                                                                {{-- <input type="text" id="suspectWeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectWeightA[]" class="form-control"  value="{{ $suspect->weight2 }}" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="10"> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Sex</label>
                                                @if ($suspect->suspect_Sex === "Male")
                                                    <select  name="suspectSexA[]" class="form-control">
                                                        <option value="{{ $suspect->suspect_Sex }}">{{ $suspect->suspect_Sex }}</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                @endif
                                                @if ($suspect->suspect_Sex === "Female")
                                                    <select  name="suspectSexA[]" class="form-control">
                                                        <option value="{{ $suspect->suspect_Sex }}">{{ $suspect->suspect_Sex }}</option>
                                                        <option value="Male">Male</option>
                                                    </select>
                                                @endif
                                                @if ($suspect->suspect_Sex === null)
                                                <select  name="suspectSexA[]" class="form-control">
                                                    <option value=" " style="font-style:italic;">Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                @endif
                                                {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="suspectSexA" name="suspectSexA[]" value="{{ $suspect->suspect_Sex }}" minlength="4" maxlength="6"> --}}
                                                <label for="">Skin tone</label>
                                                <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectSkinToneA[]" class="form-control"  value="{{ $suspect->skin_tone }}" onkeypress="validateColor(event)" minlength="1" maxlength="70">
                                                <label for="">Height (cm)</label>
                                                    @if ($suspect->height2 === null)
                                                    <input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightOne" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" value="{{ $suspect->height }}" name="suspectHeightA[]" placeholder="Height" autocomplete="off">
                                                    {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectHeightA[]" class="form-control"  value="{{ $suspect->height }}" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="10"> --}}
                                                    @else
                                                        <div class="form-group">
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                        <input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightOne" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" value="{{ $suspect->height }}" name="suspectHeightA[]" placeholder="Height" autocomplete="off">
                                                                    {{-- <input type="text" id="suspectHeightOne" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectHeightA[]" class="form-control"  value="{{ $suspect->height }}" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="10"> --}}
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <input type="number" max="300" min="50" pattern=".*\S+.*" id="suspectHeightTwo" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" value="{{ $suspect->height2 }}" name="suspectHeightTwo[]" placeholder="Height" autocomplete="off">
                                                                    {{-- <input type="text" id="suspectHeightTwo" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="suspectHeightTwo[]" class="form-control"  value="{{ $suspect->height2 }}" onkeypress="validateWeightAndHeight(event)" minlength="1" maxlength="10"> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                            </div>
                                            <input type="hidden" class="form-control" name="suspectID[]" id="suspectID[]" value="{{ $suspect->id }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    <hr>
                    <button class="btn btn-success btn-add add_button1" fldnum="1" type="button" style="float:right;">
                        <span class="fas">+</span>
                    </button>
                    <p style="font-weight:bold;">3. Nature of act complained &#40; * &#41; </p>
                    {{--
                    <p style="font-style:italic;font-size:18px;">Please double click &#40; X &#41; to delete the nature.</p>
                     --}}
                        @foreach($nature as $nature)
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <div class="fld_wrap" id="fld1">
                                            <div class="input-group">
                                                <input class="form-control" name="natureName" id="natureName"  value="{{ $nature->nature}}" readonly>
                                                <input type="hidden" class="form-control" name="fld_val1[]" id="fld_val1[]" value="{{ $nature->natureid }}" readonly>
                                                <input type="hidden" class="form-control" name="caseNatureID[]" id="caseNatureID[]" value="{{ $nature->cnatureid }}">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-success btn-danger btn-add add_button1 remove_button" fldnum="1" type="button">
                                                        <span class="fas ">X</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    <hr>
                        <section>
                            <div class="form-group">
                                <p style="font-weight:bold;">4. Where and when committed</p>
                                <div class="form-row">
                                @if(!$count)
                                    <div class="col-md-6">
                                        <label for="whereCommitted">Place Committed</label>
                                        <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="whereCommitted" id="whereCommitted" class="form-control"  value=""  minlength="3" maxlength="30">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="whenCommitted">When Committed</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="btn btn-secondary">
                                                    <i class="fas fa-fw fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" pattern=".*\S+.*" title="This field is required." name="whenCommitted" id="whenCommitted" class="form-control">
                                        </div>
                                    </div>
                                @else
                                    @foreach($whenAndWhere as $whenAndWhere)
                                        <div class="col-md-6">
                                            <label for="whereCommitted">Place Committed</label>
                                            <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." name="whereCommitted" id="whereCommitted" class="form-control"  value="{{ $whenAndWhere->place_Committed }}"  minlength="3" maxlength="30">
                                            <input type="hidden" pattern=".*\S+.*" title="This field is required." class="form-control" name="complaintSheetID" id="complaintSheetID" value="{{ $whenAndWhere->id }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="whenCommitted">When Committed</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="btn btn-secondary">
                                                        <i class="fas fa-fw fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" pattern=".*\S+.*" title="This field is required." name="whenCommitted" id="whenCommitted" class="form-control"  value="{{ $whenAndWhere->date_Committed }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </section>
                    <hr>
                        <button class="btn btn-success btn-add add_button4" fldnum="4" type="button" style="float:right;">
                            <span class="fas">+</span>
                        </button>
                        <p style="font-weight:bold;">5. Victim/s If any</p>
                        @foreach($victim as $victim)
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="control-group">
                                        <div class="fld_wrap" id="fld4">
                                            <div class="input-group">
                                                <div class="col-md-3">
                                                    <label for="">Name &#40; * &#41;</label>
                                                        <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Name is required." class="form-control" id="victimNameA" name="victimNameA[]" value="{{ $victim->victim_name }}" style="background-color:#dd8282;" minlength="2" maxlength="100">
                                                    <label for="">Age</label>
                                                        <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="victimAgeA" name="victimAgeA[]" value="{{ $victim->victim_Age }}" minlength="1" maxlength="3">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Address</label>
                                                        <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="victimAddressA" name="victimAddressA[]" value="{{ $victim->victim_Address }}" minlength="5" maxlength="255">
                                                    <label for="">Civil Status</label>
                                                    <select  name="victimCivilStatusA[]" class="form-control">
                                                        <option value="{{ $victim->victim_Civil_Status }}">{{ $victim->victim_Civil_Status }}</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Separated">Separated</option>
                                                    </select>
                                                        {{-- <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="victimCivilStatusA" name="victimCivilStatusA[]" value="{{ $victim->victim_Civil_Status }}" minlength="5" maxlength="20"> --}}
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Telephone Number</label>
                                                        <input type="text" pattern=".*\S+.*" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" class="form-control" id="victimTelNumberA" name= "victimTelNumberA[]" value="{{ $victim->victim_Contact_Number }}" minlength="5" maxlength="15">
                                                    <label for="">Occupation</label>
                                                        <input type="text" pattern=".*\S+.*" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" id="victimOccupationA" name="victimOccupationA[]"value="{{ $victim->victim_Occupation }}" minlength="4" maxlength="60">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Sex</label>
                                                    @if ($victim->victim_Sex === "Male")
                                                        <select  name="victimSexA[]" class="form-control">
                                                            <option value="{{ $victim->victim_Sex }}">{{ $victim->victim_Sex }}</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    @endif
                                                    @if ($victim->victim_Sex === "Female")
                                                         <select  name="victimSexA[]" class="form-control">
                                                            <option value="{{ $victim->victim_Sex }}">{{ $victim->victim_Sex }}</option>
                                                            <option value="Male">Male</option>
                                                        </select>
                                                    @endif
                                                    @if ($victim->victim_Sex === null)
                                                        <select  name="victimSexA[]" class="form-control">
                                                            <option value=" " style="font-style:italic;">Sex</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    @endif
                                                        {{-- <input type="text" pattern=".*\S+.*" title="This field is required." class="form-control" id="victimSexA" name="victimSexA[]" value="{{ $victim->victim_Sex }}" minlength="4" maxlength="6"> --}}
                                                        <input type="hidden" class="form-control" name="victimID[]" id="victimID[]" value="{{ $victim->id }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    <hr>
                @if (!$count)
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">6. Narration of Facts</p>
                            <textarea id="narrationOfFacts" name="narrationOfFacts"  style="width:100%;font-size:15px;resize:none;" rows="5" ></textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what people agency?</p>
                            <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" ></textarea>
                            <br>
                            <p style="font-weight:bold;">Status of investigation, If any</p>
                            <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535"></textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where?</p>
                            <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535"></textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI?</p>
                            <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535"></textarea>
                        </div>
                    </section>
                @else
                    @foreach($complaintSheet as $complaintSheet)
                    <section>
                        <input type="hidden" class="form-control" name="complainSheetID" id="complainSheetID" value="{{ $complaintSheet->id }}" readonly>
                        <div class="form-group">
                            <p style="font-weight:bold;">6. Narration of Facts</p>
                            <textarea id="narrationOfFacts" name="narrationOfFacts"  style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535">{{ $complaintSheet->narration_Of_Facts }}</textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what people agency?</p>
                            <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535">{{ $complaintSheet->reported_Any_Agency }}</textarea>
                            <br>
                            <p style="font-weight:bold;">Status of investigation, If any</p>
                            <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535">{{ $complaintSheet->status_of_Investigation }}</textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where?</p>
                            <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535">{{ $complaintSheet->where_court_Proceedings }}</textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI?</p>
                            <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" maxlength="65,535">{{ $complaintSheet->report_Considerations }}</textarea>
                        </div>
                    </section>
                    @endforeach
                @endif
                <br>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="">
                                    <input type="hidden" id="description" name="description" class="form-control" value="Encoder update the case information with case docketnumber = ">
                                    <input type="hidden" id="action" name="action" class="form-control" value="Update"> {{-- QUERY HERE --}}
                                    <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="border-style: outset;border-color:blue;">
                        <br>
                        <center>
                            <button type="submit" class="btn btn-primary" style="font-size:20px;font-weight: bold;" onclick="validateDocketnumber();validateSeven();validateRangeAge();validateRangeHeight();validateRangeWeight();return validateCase();">Submit</button>
                        </center>
                        <br>
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

    <script>
            $(document).ready(function(){
                $('.add_button2').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML =    '<div class="input-group">'+
                            '<div class="input-group-prepend">'+
                                    '<button class="btn btn-danger btn-add add_button2 remove_button2" fldnum="2" type="button">'+
                                        '<span class="fas">x</span>'+
                                    '</button>'+
                                '</div>'+
                            '<div class="col-md-5">'+
                                    '<label for="agent">Investigator</label>'+
                                '<select name="fld_val2[]" id="fld_val2"  class="form-control" required>'+
                                    '<option value=""></option>'+
                                '@foreach($agent2 as $agent2)'+
                                    '<option value="{{ $agent2->userid }}">{{ $agent2->agentName }}</option>'+
                                '@endforeach'+
                                '</select>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                                    '<label for="agent">Date Assigned</label>'+
                                '<input type="date" class="form-control" name="dateAssigned[]" id="dateAssigned" required>'+
                            '</div>'+
                        '</div>';
                    $("#fld2").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button2', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
            $(document).ready(function(){
                $('.add_button1').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML = '<div class="input-group">'+
                            '<select  name="fld_val1[]" id="fld_val1" class="form-control" required>'+
                            '<option value=""></option>'+
                            '@foreach($nature2 as $nature2)'+
                            '<option value="{{ $nature2->natureid }}">{{ $nature2->nature }}</option>'+
                            '@endforeach'+
                            '</select>'+
                            '<div class="input-group-prepend">'+
                            '<button class="btn btn-danger btn-add add_button1 remove_button" fldnum="1" type="button">'+
                            '<span class="fas">x</span>'+
                            '</button>'+
                            '</div>';
                    $("#fld1").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
    </script>
    <script>
        var dateControler = {
            currentDate : null
        }

         $(document).on( "change", "#dateAssigned",function( event, ui ) {
                var now = new Date();
                var selectedDate = new Date($(this).val());

                if(selectedDate > now) {
                    $(this).val(dateControler.currentDate)
                } else {
                    dateControler.currentDate = $(this).val();
                }
            });
    </script>
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
    </script>
    <script>
            $(document).ready(function(){
                $('.add_button3').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML =                                '<div class="input-group">'+
                            '<div class="col-md-3">'+
                                    '<input type="text" style="background-color:#c9c9bd;"  title="White-spaces is not accepted. Name is required." class="form-control" name="suspectNameA[]" placeholder="Name" autocomplete="off" minlength="2" maxlength="100" required>'+
                                    '<br>'+
                                    '<div class="form-group">'+
                                        '<div class="form-row">'+
                                            '<div class="col-md-6">'+
                                                '<select id="displaySexA"  name="suspectSexA[]" class="form-control" required>'+
                                                    '<option value=" " style="font-style:italic;">Sex</option>'+
                                                    '<option value="Male">Male</option>'+
                                                    '<option value="Female">Female</option>'+
                                                '</select>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<select name="statusA[]" id="" class="form-control">'+
                                                    '<option value="Innocent">Innocent</option>'+
                                                    '<option value="Guilty">Guilty</option>'+
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
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

                $('.fld_wrap').on('click', '.remove_button3', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
            $(document).ready(function(){
                $('.add_button4').click(function(){
                    var kakoi=$(this).attr('fldnum');
                    var insHTML ='<div class="input-group">'+
                                    '<div class="input-group-prepend">'+
                                        '<button class="btn btn-danger btn-add add_button4 remove_button4" fldnum="4" type="button">'+
                                            '<span class="fas">X</span>'+
                                        '</button>'+
                                    '</div>'+
                                    '<br>'+
                                    '<br>'+
                                    '<div class="col-md-3">'+
                                        '<input type="text" title="White-spaces is not accepted. Name is required." class="form-control" name="victimNameA[]" placeholder="Name" autocomplete="off" required minlength="5" maxlength="40">'+
                                        '<input type="text" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimAgeA[]" placeholder="Age" autocomplete="off" minlength="1" maxlength="3">'+
                                    '</div>'+
                                    '<div class="col-md-3">'+
                                        '<input type="text" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimAddressA[]" placeholder="Address" autocomplete="off" minlength="5" maxlength="255">'+
                                        '<select  name="victimCivilStatusA[]" class="form-control">'+
                                            '<option value=" " style="font-style:italic;">Civil Status</option>'+
                                            '<option value="Single">Single</option>'+
                                            '<option value="Married">Married</option>'+
                                            '<option value="Widowed">Widowed</option>'+
                                            '<option value="Divorced">Divorced</option>'+
                                            '<option value="Separated">Separated</option>'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="col-md-3">'+
                                        '<input type="text" title="+ , - , and numbers are the characters only accepted." onkeypress="validateTelephone(event)" id="suspectTelNumberA" name= "victimTelNumberA[]" autocomplete="off" placeholder="Telephone Number" class="ccNumber form-control" value="" autocomplete="off" minlength="5" maxlength="15">'+
                                        '<input type="text" title="White-spaces is not accepted. Leave it blank if no information will be encoded." class="form-control" name="victimOccupationA[]" placeholder="Occupation" autocomplete="off"  minlength="4" maxlength="60">'+
                                    '</div>'+
                                    '<select  name="victimSexA[]" class="form-control">'+
                                        '<option value=" " style="font-style:italic;">Sex</option>'+
                                        '<option value="Male">Male</option>'+
                                        '<option value="Female">Female</option>'+
                                    '</select>'+
                                '</div>';
                    $("#fld4").append(insHTML);
                });

                $('.fld_wrap').on('click', '.remove_button4', function(e){
                    e.preventDefault();
                    $(this).parents(':eq(1)').remove();
                });
            });
    </script>
    <script>
            whenCommitted.max = new Date().toISOString().split("T")[0];
    </script>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
        alert(msg);
        }
    </script>
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
            var caseStatus = document.getElementById('caseStatus').value;

            /**
            *if((acmo == "" && ccn == "" ) && caseStatus != "Under Investigation"){
            *    alert('You must provide ACMO and CCN in order to change the case status.')
            *    return false;
            *}else
            */
            if((acmo == "" && ccn !== "")||(acmo !== "" && ccn == "")){
                alert('Encoding of ACMO and CCN can not be separated. ')
                return false;
            }else{
                return true;
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
