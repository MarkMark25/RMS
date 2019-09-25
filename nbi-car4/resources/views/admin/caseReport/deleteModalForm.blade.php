<div class="form-group">
        <div class="form-row">
            <div class="col-md-4">
                <label for="ccn">CCN</label>
                <div class="input-group mb-2">
                    <input type="text" id="ccn" name= "ccn" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <label for="acmo">ACMO No.</label>
                <div class="">
                        <input type="text" id="acmo" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <label for="caseNumber">Car Case Number</label>
                <div class="input-group mb-2">
                    <input type="text" id="docketnumber" name="docketnumber" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-4">
                <label for="dateassigned">Date Assigned</label>
                <div class="">
                    <input type="text" id="dateassigned" name="dateassigned" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <label for="dateTerminated">Date Terminated</label>
                <div class="">
                    <input type="text" id="dateTerminated" name="dateTerminated" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <label for="status">Status</label>
                <div class="">
                    <input type="text" id="status" name= "status" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
                <label for="agent">Agent</label>
                <div class="">
                    <textarea class="form-control" name="full_name" id="full_name" style="width:100%;font-size:15px;resize:none;" rows="2" disabled></textarea>{{-- QUERY HERE --}}
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
                    <input type="text" id="complainant" name="complainant"  class="form-control" disabled/>  {{-- QUERY HERE --}}
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Address</label>
                <div class="">
                    <input type="text" id="complainantAddress" name="complainantAddress"  class="form-control" disabled/>  {{-- QUERY HERE --}}
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Telephone Number</label>
                <div class="">
                    <input type="text" id="complainantTelNumber" name="complainantTelNumber"  class="form-control" disabled/>  {{-- QUERY HERE --}}
                </div>
            </div>
        </div>
    </div>
<hr>
    <div class="form-group">
        <p style="font-weight:bold;">2. Persons Complained Against or Suspects (Isinusumbong)</p>
        <div class="form-row">
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectNameA" name="suspectNameA" placeholder="Name" disabled>
                <input type="text" class="form-control" id="suspectAge" name="suspectAge" placeholder="Age" disabled>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectAddressA" name="suspectAddressA" placeholder="Address" disabled>
                <input type="text" class="form-control" id="suspectCivilStatusA" name="suspectCivilStatusA" placeholder="Civil Status" disabled>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectTelNumberA" name= "suspectTelNumberA"  placeholder="Telephone Number" disabled>
                <input type="text" class="form-control" id="suspectOccupationA" name="suspectOccupationA" placeholder="Occupation" disabled>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="suspectSexA" name="suspectSexA" placeholder="sex" disabled>
            </div>
        </div>
    </div>
<hr>
    <p style="font-weight:bold;">3. Nature of act complained (Uri ng sumbong) </p>
    <section>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-12">
                    <textarea class="form-control" name="nameOfNature" id="nameOfNature" style="width:100%;resize:none;" rows="2" disabled></textarea>
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
                    <input type="text" name="whereCommitted" id="whereCommitted" class="form-control" disabled>
                </div>
                <div class="col-md-6">
                    <label for="whenCommitted">When Committed</label>
                    <input type="text" name="wheneCommitted" id="wheneCommitted" class="form-control" disabled>
                </div>
            </div>
        </div>
    </section>
<hr>
<div class="form-group">
        <p style="font-weight:bold;">5. Victim/s If any</p>
        <div class="form-row">
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimNameA" name="victimNameA" placeholder="Name" disabled>
                <input type="text" class="form-control" id="victimAge" name="victimAge" placeholder="Age" disabled>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimAddressA" name="victimAddressA" placeholder="Address" disabled>
                <input type="text" class="form-control" id="victimCivilStatusA" name="victimCivilStatusA" placeholder="Civil Status" disabled>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimTelNumberA" name= "victimTelNumberA"  placeholder="Telephone Number" disabled>
                <input type="text" class="form-control" id="victimOccupationA" name="victimOccupationA" placeholder="Occupation" disabled>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="victimSexA" name="victimSexA" placeholder="sex" disabled>
            </div>
        </div>
    </div>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">6. Narration of Facts (Salaysay ng mga Pangyayari) </p>
            <textarea id="narrationOfFacts" name="narrationOfFacts"  style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">7. Has the matter been reported to any agency, If so, to what people agency? (Ang bagay bang ito ay naulat na sa ibang sangay ng pagsisiyasat? Kung naulat na, saang sangay?) </p>
            <textarea name="hasTheMatter" id="hasTheMatter" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
            <br>
            <p style="font-weight:bold;">Status of investigation, If any (Kalagayan ng pagsisiyasat kung mayroon?)</p>
            <textarea name="statusOfInvestigation" id="statusOfInvestigation" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">8.Is the matter complained of the subject of any court action of proceedings? If so, where? (Ang bagay bang may kinalaman sa pagsusumbong ay nasa hukuman na? Kung gaanoon, saan?)</p>
            <textarea name="isTheMatterComplained" id="isTheMatterComplained" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
        </div>
    </section>
<hr>
    <section>
        <div class="form-group">
            <p style="font-weight:bold;">9.What Consideration/s impelled you to report to the NBI? (Ano ang nag-udyok sa iyo para magreklamo dito sa NBI?)</p>
            <textarea name="whatConsidirations" id="whatConsidirations" style="width:100%;font-size:15px;resize:none;" rows="5" disabled></textarea>
        </div>
    </section>
    <div class="form-group">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="">
                        <input type="hidden" id="caseStatus" name="caseStatus" class="form-control" value="Deleted">
                        <input type="hidden" id="descriptionOne" name="descriptionOne" class="form-control" value="Administrator delete case with case id = ">
                        <input type="hidden" id="action" name="action" class="form-control" value="Delete"> {{-- QUERY HERE --}}
                        <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                    </div>
                </div>
            </div>
        </div>
