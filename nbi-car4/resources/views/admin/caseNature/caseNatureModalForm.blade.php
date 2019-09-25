<div class="form-group">
    <div class="form-row">
        <div class="col-md-12">
            <label for="ccn">Nature</label>
            <div class="input-group mb-2">
                <input type="text" id="nature" pattern=".*\S+.*" title="Please provide the case nature." name= "nature" autocomplete="off" class="form-control" required> {{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-row">
        <div class="col-md-12">
            <div class="">
                <input type="hidden" id="descriptionOne" name="descriptionOne" class="form-control" value="Administrator update case nature details with nature name = ">
                <input type="hidden" id="action" name="action" class="form-control" value="Update"> {{-- QUERY HERE --}}
                <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
            </div>
        </div>
    </div>
</div>
