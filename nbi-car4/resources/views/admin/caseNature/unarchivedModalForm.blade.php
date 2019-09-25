    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <label for="ccn">Nature</label>
                <div class="input-group mb-2">
                    <input type="text" id="nature" name= "nature" autocomplete="off" class="form-control" readonly> {{-- QUERY HERE --}}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <div class="">
                    <input type="hidden" id="natureAvailability" name="natureAvailability" class="form-control" value="Available">
                    <input type="hidden" id="descriptionOne" name="descriptionOne" class="form-control" value="Administrator un-archived the case nature with nature name = ">
                    <input type="hidden" id="action" name="action" class="form-control" value="Unarchived"> {{-- QUERY HERE --}}
                    <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                </div>
            </div>
        </div>
    </div>
