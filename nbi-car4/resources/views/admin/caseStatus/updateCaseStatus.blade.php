<div class="form-group">
    <div class="form-row">
        <div class="col-md-12">
            <label for="ccn">Status</label>
            <div class="input-group mb-2">
                <textarea class="form-control" name="status" id="status" style="width:100%;font-size:15px;resize:none;" rows="5"></textarea>{{-- QUERY HERE --}}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-row">
        <div class="col-md-12">
            <div class="">
                <input type="hidden" id="descriptionOne" name="descriptionOne" class="form-control" value="Administrator update new case status with status name = ">
                <input type="hidden" id="action" name="action" class="form-control" value="Update"> {{-- QUERY HERE --}}
                <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
            </div>
        </div>
    </div>
</div>
