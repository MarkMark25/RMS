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
   
      <script src="{{URL::to('bower_components/js/canvasjs.min.js')}}"></script>
     <style>
            th {
                font-size:15px;
            }
            td {
                font-size:15px;
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
        <div id="content-wrapper" >
          <a href="/agentHome" class="btn btn-secondary" style="margin-left:20px;">
            <i class="fas fa-backward"></i>
              <span>Back</span>
          </a>
        <div class="container-fluid" style="padding-bottom:1%; padding-top:2%; padding-left:6%;">
          <div class="card mb-3" style="width:100%%;">
            <center><div id="page-top" class="card-header bg-light text-dark" href="#" data-toggle="modal" >
              <h4>Review case details and complaint sheet</h4></div></center>
            <div class="card-body bg-light text-dark">
              @foreach($showData as $showData)
              <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="">Date and Time Encoded</label>
                                    <input type="text" id="dateEncoded" name= "dateEncoded" class="form-control"  value="{{ $showData->date_created }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Date and Time Updated</label>
                                    <input type="text" id="dateUpdated" name= "dateUpdated" class="form-control"  value="{{ $showData->date_updated }}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
              <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="ccn">CCN</label>
                                    <input type="text" id="ccn" name= "ccn" class="form-control"  value="{{ $showData->ccn }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="acmo">ACMO No.</label>
                                    <input type="text" id="acmo" class="form-control"  value="{{ $showData->acmo}}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="caseNumber">Car Case Number</label>
                                    <div class="input-group mb-2">
                                        <input type="text" id="docketnumber" name="docketnumber" class="form-control"  value="{{ $showData->docketnumber }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="dateTerminated">Date Terminated</label>
                                    <input type="text" id="dateTerminated" name="dateTerminated" class="form-control"  value="{{ $showData->terminated_date}}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <label for="status">Status</label>
                                    <input type="text" id="status" name= "status" class="form-control"  value="{{ $showData->stat}}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <strong>Investigator</strong>
                            <p>Note: <strong style="background-color:#F48A81;">Light Coral</strong> - previous agent and <strong style="background-color:#adf4c5;">Magic Mint</strong> - current agent </p>
                            <div class="form-row">
                                @foreach($agent as $agent)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="agent">Name</label>
                                                 @if ($agent->agent_status === "Current")
                                                    <input type="text" style="background-color:#adf4c5;" id="full_name" name= "full_name" class="form-control"  value="{{ $agent->agentFName}}" disabled>
                                                @else
                                                    <input type="text" style="background-color:#F48A81;" id="full_name" name= "full_name" class="form-control"  value="{{ $agent->agentFName}}" disabled>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label for="agent">Date Assigned</label>
                                                @if ($agent->agent_status === "Current")
                                                <input type="text" style="background-color:#adf4c5;" id="dateAssigned" name= "dateAssigned" class="form-control"  value="{{ $agent->assigned_date}}" disabled>
                                                @else
                                                <input type="text" style="background-color:#F48A81;" id="dateAssigned" name= "dateAssigned" class="form-control"  value="{{ $agent->assigned_date}}" disabled>
                                                @endif
                                            </div>
                                            <!--div class="col-md-2">
                                                <label for="agentStat">Status</label>
                                                <input type="text" id="agentStat" name= "agentStat" class="form-control"  value="{{ $agent->agent_status}}" disabled>
                                            </div-->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        <hr>
                    <div class="form-group">
                            <p style="font-weight:bold;">1. Complainant</p>
                            <div class="form-row">
                                <div class="col-md-12">
                                  <label for="complainantName">Name</label>
                                    @if ($showData->complainant_organization === null)
                                      <input type="text" id="complainant" name="complainant"  class="form-control"  value="{{ $showData->complainantname}}" disabled/> 
                                    @else
                                      <textarea name="complainant" id="complainant" style="width:100%;font-size:16px;resize:none;" rows="2" disabled>{{ $showData->complainant_organization}} represented by {{ $showData->complainantname}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                              <div class="form-row">
                                <div class="col-md-9">
                                    <label for="">Address</label>
                                    <div class="">
                                        <input type="text" id="complainantAddress" name="complainantAddress"  class="form-control"  value="{{ $showData->complainant_Address}}" disabled/>  {{-- QUERY HERE --}}
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <label for="">Telephone Number</label>
                                    <div class="">
                                        <input type="text" id="complainantTelNumber" name="complainantTelNumber"  class="form-control"  value="{{ $showData->complainant_Contact_Number}}" disabled/>  {{-- QUERY HERE --}}
                                    </div>
                              </div>
                              </div>
                                </div>
                    <hr>
                     <div class="form-group">
                            <p style="font-weight:bold;">2. Persons Complained Against or Suspects</p>
                            @foreach($suspects as $suspects)
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" id="suspectNameA" name="suspectNameA" value="{{ $suspects->suspect_name }}" style="background-color:#dd8282;" disabled>
                                  </div>
                                  <div class="col-md-2">
                                    <label for="">Sex</label>
                                    <input type="text" class="form-control" id="suspectSexA" name="suspectSexA" value="{{ $suspects->suspect_Sex }}" disabled>
                                </div>
                                <div class="col-md-1">  
                                    <label for="">Age</label>
                                       <input type="text" class="form-control" id="suspectAge" name="suspectAge"  value="{{ $suspects->suspect_Age }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Civil Status</label>
                                    <input type="text" class="form-control" id="suspectCivilStatusA" name="suspectCivilStatusA" value="{{ $suspects->suspect_Civil_Status }}" disabled>
                                </div>
                              </div>
                              <br>
                            <div class="form-row">
                                <div class="col-md-9">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" id="suspectAddressA" name="suspectAddressA" value="{{ $suspects->suspect_Address }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Telephone Number</label>
                                    <input type="text" class="form-control" id="suspectTelNumberA" name= "suspectTelNumberA" value="{{ $suspects->suspect_Contact_Number }}" disabled>
                                </div>
                              </div>
                              <br>
                              <div class="form-row">
                                <div class="col-md-6">
                                    <label for="">Occupation</label>
                                    <input type="text" class="form-control" id="suspectOccupationA" name="suspectOccupationA" value="{{ $suspects->suspect_Occupation }}" disabled>
                                </div>
                                 <div class="col-md-3">
                                    <label for="">Status</label>
                                    @if($suspects->status === "Guilty")
                                    <input type="text" class="form-control" style="background-color:#dd8282;font-weight:bold;" id="statusA" name="statusA" value="{{ $suspects->status }}" disabled>
                                    @else
                                    <input type="text" class="form-control" style="background-color:#a0efa4;" id="statusA" name="statusA" value="{{ $suspects->status }}" disabled>
                                    @endif
                                </div>
                            </div>
                            <br>
                        <p style="font-weight:bold;">Other Information</p>
                            <div class="form-row">
                                <div class="col-md-2">
                                    <label for="">Height</label>
                                    <input type="text" class="form-control"  value="{{ $suspects->height }}" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Weight</label>
                                    <input type="text" class="form-control"  value="{{ $suspects->weight }}" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Eye Color</label>
                                    <input type="text" class="form-control"  value="{{ $suspects->eye_color }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Hair Color</label>
                                    <input type="text" class="form-control"  value="{{ $suspects->hair_color }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Skin tone</label>
                                    <input type="text" class="form-control"  value="{{ $suspects->skin_tone }}" disabled>
                                </div>
                        </div>
                      </div>
                    <hr>
                    @endforeach
                    <p style="font-weight:bold;">3. Nature of act complained</p>
                        <section>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="nameOfNature" id="nameOfNature"  value="{{ $showData->natureName}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <hr>
                    <section>
                            <div class="form-group">
                                <p style="font-weight:bold;">4. Where and when committed</p>
                                <div class="form-row">
                                <div class="col-md-8">
                                    <label for="whereCommitted">Place Committed</label>
                                    <input type="text" name="whereCommitted" id="whereCommitted" class="form-control"  value="{{ $showData->place_Committed }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="whenCommitted">When Committed</label>
                                     @if ($showData->date_Committed === '0000-00-00' or $showData->date_Committed === null)
                                      <input type="text" name="whenCommitted" id="whenCommitted" class="form-control" disabled>
                                    @else
                                        <input type="text" name="whenCommitted" id="whenCommitted" class="form-control"  value="{{ $showData->date_Committed }}" disabled>
                                    @endif
                                </div>
                                </div>
                            </div>
                        </section>
                    <hr>
                     <div class="form-group">
                            <p style="font-weight:bold;">5. Victim/s If any</p>
                            @foreach($victims as $victim)
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" id="victimNameA" name="victimNameA" value="{{ $victim->victim_name }}" style="background-color:#dd8282;" disabled>
                                </div>
                                 <!--div class="col-md-7">
                                        <label for="affilition">Affilitation</label>
                                    <div class="">
                                        <input type="text" id="affiliation" name="affiliation"  class="form-control"  value="sukatam daytuy girl!!!!" disabled/>  {{-- QUERY HERE --}}
                                    </div>
                                </div-->
                                <div class="col-md-2">
                                    <label for="">Sex</label>
                                    <input type="text" class="form-control" id="victimSexA" name="victimSexA" value="{{ $victim->victim_Sex }}" disabled>
                                </div>
                                <div class="col-md-1">  
                                    <label for="">Age</label>
                                    @if ($suspects->suspect_Age == '0' or $suspects->suspect_Age === null)
                                      <input type="text" class="form-control" id="victimAge" name="victimAge" disabled>
                                    @else
                                       <input type="text" class="form-control" id="victimAge" name="victimAge"  value="{{ $victim->victim_Age }}" disabled>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="">Civil Status</label>
                                    <input type="text" class="form-control" id="victimCivilStatusA" name="victimCivilStatusA" value="{{ $victim->victim_Civil_Status }}" disabled>
                                </div>
                              </div>
                              <br>
                            <div class="form-row">
                                <div class="col-md-8">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" id="victimAddressA" name="victimAddressA" value="{{ $victim->victim_Address }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Telephone Number</label>
                                    <input type="text" class="form-control" id="victimTelNumberA" name= "victimTelNumberA" value="{{ $victim->victim_Contact_Number }}" disabled>
                                </div>
                              </div>
                              <br>
                              <div class="form-row">
                                 <!--div class="col-md-2">
                                    <label for="">Sex</label>
                                    <input type="text" class="form-control" id="victimSexA" name="victimSexA" value="{{ $victim->victim_Sex }}" disabled>
                                </div>
                                <div class="col-md-1">  
                                    <label for="">Age</label>
                                    @if ($suspects->suspect_Age == '0' or $suspects->suspect_Age === null)
                                      <input type="text" class="form-control" id="victimAge" name="victimAge" disabled>
                                    @else
                                       <input type="text" class="form-control" id="victimAge" name="victimAge"  value="{{ $victim->victim_Age }}" disabled>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="">Civil Status</label>
                                    <input type="text" class="form-control" id="victimCivilStatusA" name="victimCivilStatusA" value="{{ $victim->victim_Civil_Status }}" disabled>
                                </div-->
                                <div class="col-md-6">
                                    <label for="">Occupation</label>
                                    <input type="text" class="form-control" id="victimOccupationA" name="victimOccupationA" value="{{ $victim->victim_Occupation }}" disabled>
                                </div>
                            </div>
                        </div>
                    <hr>
                  @endforeach
                  <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">6. Narration of Facts</p>
                            <textarea id="narrationOfFacts" name="narrationOfFacts"  style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->narration_Of_Facts }}</textarea>
                        </div>
                    </section>
                    <hr>
                     <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what police agency?</p>
                            <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->reported_Any_Agency }}</textarea>
                            <br>
                            <p style="font-weight:bold;">Status of investigation, If any</p>
                            <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->status_of_Investigation }}</textarea>
                        </div>
                    </section>
                    <hr>
                     <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">8. Is the matter complained of the subject of any court action or proceedings? If so, where?</p>
                            <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->where_court_Proceedings }}</textarea>
                        </div>
                    </section>
                    <hr>
                    <section>
                        <div class="form-group">
                            <p style="font-weight:bold;">9. What Consideration/s impelled you to report to the NBI?</p>
                            <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->report_Considerations }}</textarea>
                        </div>
                    </section>
              @endforeach
    </div>
    </div>
            <div class="card mb-3" style="width:100%%;">
              <div id="page-top" class="card-header" href="#" data-toggle="modal" >Case Reports</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="table-responsive">
                      <table class="table table-striped " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Report</th>
                            <th>Date and Time Uploaded</th>
                          </tr>
                        </thead>
                          @foreach($casereport as $creport)
                          <tr>
                            <td>
                              <input type="hidden" value="{{ $creport->report }}"/>
                              <a href="{{ route('getAgentReport',[$creport->report]) }}" target="_blank" style="color:black;" onMouseOver="this.style.color='#00BFFF'" onMouseOut="this.style.color='#000000'">{{ $creport->report }}
                              </a>
                            </td>
                            <td>{{ $creport->dateUploaded }}</td>
                          </tr>
                          @endforeach
                    </table>
                  </div>
                </div>
              </div>
                <div class="card-footer small text-muted">
                  @foreach($latestUpdate as $latestUpdate)
                   @if ($latestUpdate->recent == null)
                   <h5> </h5>
                   @else 
                    Last updated on {{ ($latestUpdate->recent) }}
                   @endif
                    @endforeach
                </div> 
              </div>
          </div>
        </div>
          <br/>
            <a href="/agentHome" class="btn btn-secondary" style="margin-left:20px;">
              <i class="fas fa-backward"></i><span> Back</span>
            </a> 
            <br>
            <br>
            <a class="scroll-to-top rounded" href="#page-top">
              <i class="fas fa-angle-up"></i>
            </a>
            
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
    <script src="{{URL::to('bower_components/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::to('bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::to('bower_components/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{URL::to('bower_components/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::to('bower_components/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{URL::to('bower_components/js/sb-admin.min.js')}}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{URL::to('bower_components/js/demo/datatables-demo.js')}}"></script>

    <script>
      $('#dataTable').dataTable( {
        "order": [[ 1, "desc" ]],
        "language": {
          "emptyTable": "No reports uploaded for this case."
        }
      } );
    </script>

  </body>
@endguest
</html>
