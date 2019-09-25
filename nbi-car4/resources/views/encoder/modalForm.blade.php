<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="ccn">CCN</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control col-md-4" value="NBI-CCN-" readonly>
                <input type="text" id="ccn" name= "ccn" autofocus autocomplete="off" class="ccNumber form-control col-md-8" value="" placeholder="C-00-00000" maxlength="10" pattern="^\w{1}-\d{2}-\d{5}$" title="Follow the following format. e.g. I-10-00001" onkeypress='validate(event)' required style="font-style:italic;"> {{-- QUERY HERE --}}
            </div>
        </div>
        <div class="col-md-6">
            <label for="acmo">ACMO No.</label>
            <div class="">
                    <input type="text" id="acmo" autocomplete="off" placeholder="00-C-00000" title="Follow the following format. e.g. 10-C-00001" maxlength="10" pattern="^\d{2}-\w{1}-\d{5}$" name= "acmo" class="form-control" value="" onkeypress='validateACMO(event)' required style="font-style:italic;"> {{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="caseNumber">Car Case Number</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control col-md-4" value="NBI-CAR-" readonly>
                <input type="text" id="docketnumber" name="docketnumber" class="form-control col-md-8"  value=""  readonly> {{-- QUERY HERE --}}
            </div>
        </div>
        <div class="col-md-6">
            <label for=complainant>Complainant</label>
            <div class="">
                <input type="text" id="complainantname" name="complainantname" class="form-control" value="" disabled> {{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="dateassigned">Date Assigned</label>
            <div class="">
                <input type="text" id="dateassigned" name="dateassigned" class="form-control" value="" disabled> {{-- QUERY HERE --}}
            </div>
        </div>
        <div class="col-md-6">
            <label for="dateTerminated">Date Terminated</label>
            <div class="">
                <input type="text" id="dateTerminated" name="dateTerminated" class="form-control" value="" disabled> {{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="status">Status</label>
            <div class="">
                <textarea class="form-control" name="status" id="status" style="width:100%;font-size:15px;resize:none;" rows="2" disabled></textarea>{{-- QUERY HERE --}}
            </div>
        </div>
        <div class="col-md-6">
            <label for="agent">Investigator</label>
            <div class="">
                <textarea class="form-control" name="full_name" id="full_name" style="width:100%;font-size:15px;resize:none;" rows="2" disabled></textarea>{{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="natureName">Nature of Case</label>
            <div class="">
                <textarea class="form-control" name="nameOfNature" id="nameOfNature" style="width:100%;font-size:15px;resize:none;" rows="2" disabled></textarea>{{-- QUERY HERE --}}
            </div>
        </div>
        <div class="col-md-6">
            <label for="subject">Subject</label>
            <div class="">
                    <textarea class="form-control" name="suspectName" id="suspectName" style="width:100%;font-size:15px;resize:none;" rows="2" disabled></textarea>{{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-12">
            <div class="">
                <input type="hidden" id="description" name="description" class="form-control" value="Encoder update case details, with case ID = ">
                <input type="hidden" id="action" name="action" class="form-control" value="Insert"> {{-- QUERY HERE --}}
                <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
            </div>
        </div>
    </div>
</div>
