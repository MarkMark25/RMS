<div class="form-group">
        <div class="form-row">
            <div class="col-md-4">
                <label for="ccn">CCN</label>
                <div class="input-group mb-2">
                    <input type="text" id="ccn" name= "ccn" class="form-control" disabled value="{{ $showData->ccn }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="acmo">ACMO No.</label>
                <div class="">
                        <input type="text" id="acmo" class="form-control" disabled value="{{ $showData->acmo }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="caseNumber">Car Case Number</label>
                <div class="input-group mb-2">
                    <input type="text" id="docketnumber" name="docketnumber" class="form-control" disabled value="{{ $showData->docketnumber }}">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-4">
                <label for="dateassigned">Date Assigned</label>
                <div class="">
                    <input type="text" id="dateassigned" name="dateassigned" class="form-control" disabled value="{{ $showData->dateassigned }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="dateTerminated">Date Terminated</label>
                <div class="">
                    <input type="text" id="dateTerminated" name="dateTerminated" class="form-control" disabled value="{{ $showData->dateTerminated }}">
                </div>
            </div>
            <div class="col-md-4">
                <label for="status">Status</label>
                <div class="">
                    <input type="text" id="status" name= "status" class="form-control" disabled value="{{ $showData->status }}">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
                <label for="agent">Agent</label>
                <div class="">
                    <textarea class="form-control" name="full_name" id="full_name" style="width:100%;font-size:15px;resize:none;" rows="2" disabled>{{ $showData->agentName }}</textarea>{{-- QUERY HERE --}}
                </div>
            </div>
        </div>
    </div>
<hr>
    <div class="form-group">
        <p style="font-weight:bold;">1. Complainant (nagsusumbong) </p>
        <div class="form-row">
            <div class="col-md-4">
                    <label for="suspectName">Name</label>
                <div class="">
                    <input type="text" id="complainant" name="complainant"  class="form-control" disabled value="{{ $showData->complainantname }}"/>  {{-- QUERY HERE --}}
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Address</label>
                <div class="">
                    <input type="text" id="complainantAddress" name="complainantAddress"  class="form-control" disabled value="{{ $showData->complainant_Address }}"/>  {{-- QUERY HERE --}}
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Telephone Number</label>
                <div class="">
                    <input type="text" id="complainantTelNumber" name="complainantTelNumber"  class="form-control" disabled value="{{ $showData->complainant_Contact_Number }}"/>  {{-- QUERY HERE --}}
                </div>
            </div>
        </div>
    </div>
<hr>
    <div class="form-group">
        <p style="font-weight:bold;">2. Persons Complained Against or Suspects (Isinusumbong)</p>
        @foreach($sample as $sample)
        <div class="form-row">
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectNameA" name="suspectNameA" placeholder="Name" disabled value="{{ $sample->suspect_name }}">
                <input type="text" class="form-control" id="suspectAge" name="suspectAge" placeholder="Age" disabled value="{{ $sample->suspect_Age }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectAddressA" name="suspectAddressA" placeholder="Address" disabled value="{{ $sample->suspect_Address }}">
                <input type="text" class="form-control" id="suspectCivilStatusA" name="suspectCivilStatusA" placeholder="Civil Status" disabled value="{{ $sample->suspect_Civil_Status }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectTelNumberA" name= "suspectTelNumberA"  placeholder="Telephone Number" disabled value="{{ $sample->suspect_Contact_Number }}">
                <input type="text" class="form-control" id="suspectOccupationA" name="suspectOccupationA" placeholder="Occupation" disabled value="{{ $sample->suspect_Occupation }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectSexA" name="suspectSexA" placeholder="sex" disabled value="{{ $sample->suspect_Sex }}">
            </div>
        </div>
        @endforeach
    </div>
<hr>
    <p style="font-weight:bold;">3. Nature of act complained (Uri ng sumbong) </p>
    <section>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <input class="form-control" name="nameOfNature" id="nameOfNature" disabled value="{{ $showData->natureName}}"></input>
                </div>
            </div>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">4. Where and when committed (Saan at Kailan Nangyari) </p>
            <div class="form-row">
                <div class="col-md-6">
                    <label for="whereCommitted">Place Committed</label>
                    <input type="text" name="whereCommitted" id="whereCommitted" class="form-control" disabled value="{{ $showData->place_Committed }}">
                </div>
                <div class="col-md-6">
                    <label for="whenCommitted">When Committed</label>
                    <input type="text" name="wheneCommitted" id="wheneCommitted" class="form-control" disabled value="{{ $showData->date_Committed }}">
                </div>
            </div>
        </div>
    </section>
<hr>
<div class="form-group">
        <p style="font-weight:bold;">5. Victim/s If any</p>
        <div class="form-row">
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimNameA" name="victimNameA" placeholder="Name" disabled value="{{ $showData->victim_name }}">
                <input type="text" class="form-control" id="victimAge" name="victimAge" placeholder="Age" disabled value="{{ $showData->victim_Age }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimAddressA" name="victimAddressA" placeholder="Address" disabled value="{{ $showData->victim_Address }}">
                <input type="text" class="form-control" id="victimCivilStatusA" name="victimCivilStatusA" placeholder="Civil Status" disabled value="{{ $showData->victim_Civil_Status }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimTelNumberA" name= "victimTelNumberA"  placeholder="Telephone Number" disabled value="{{ $showData->victim_Contact_Number }}">
                <input type="text" class="form-control" id="victimOccupationA" name="victimOccupationA" placeholder="Occupation" disabled value="{{ $showData->victim_Occupation }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimSexA" name="victimSexA" placeholder="sex" disabled value="{{ $showData->victim_Sex }}">
            </div>
        </div>
    </div>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">6. Narration of Facts (Salaysay ng mga Pangyayari) </p>
            <textarea id="narrationOfFacts" name="narrationOfFacts"  style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->narration_Of_Facts }}</textarea>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what police agency? (Ang bagay bang ito ay naulat na sa ibang sangay ng pagsisiyasat? Kung naulat na, saang sangay?) </p>
            <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->reported_Any_Agency }}</textarea>
            <br>
            <p style="font-weight:bold;">Status of investigation, If any (Kalagayan ng pagsisiyasat kung mayroon?)</p>
            <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->status_of_Investigation }}</textarea>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where? (Ang bagay bang may kinalaman sa pagsusumbong ay nasa hukuman na? Kung gaanoon, saan?)</p>
            <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->where_court_Proceedings }}</textarea>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI? (Ano ang nag-udyok sa iyo para magreklamo dito sa NBI?)</p>
            <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" disabled>{{ $showData->report_Considerations }}</textarea>
        </div>
    </section>
