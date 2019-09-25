<div class="form-group">
    <div class="form-row">
    <div class="col-md-5">
        <label for="firstName">First name</label>
        <div class="">
        <input type="text" pattern=".*\S+.*" title="This field is required." id="firstName" name="firstName" class="form-control" value="" maxlength="50"> {{-- QUERY HERE --}}
        </div>
    </div>
    <div class="col-md-2">
        <label for="mid">Middle Initial</label>
        <div class="">
        <input type="text" pattern=".*\S+.*" id="middleInitial" name="middleInitial" class="form-control" value="" maxlength="5"> {{-- QUERY HERE --}}
        </div>
    </div>
    <div class="col-md-5">
        <label for="lastName">Last name</label>
        <div class="">
        <input type="text" pattern=".*\S+.*" title="This field is required." id="lastName" name="lastName" class="form-control" value="" maxlength="50"> {{-- QUERY HERE --}}
        </div>
    </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
    <div class="col-md-6">
        <label for="userName">Username</label>
        <div class="">
        <input type="text" pattern=".*\S+.*" title="This field is required." id="username" name="username" class="form-control" value="" maxlength="50"> {{-- QUERY HERE --}}
        </div>
    </div>
    <div class="col-md-6">
        <label for="role">Role</label>
        <input type="text" id="role" name="role" class="form-control" value="" disabled> {{-- QUERY HERE --}}
    </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="">Status</label>
            <select name="userStatus" id="userStatus" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Reassigned">Reassigned</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <div class="">
                    <input type="hidden" id="description" name="description" class="form-control" value="Administrator user details update, with the username = ">
                    <input type="hidden" id="action" name="action" class="form-control" value="Update"> {{-- QUERY HERE --}}
                    <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                </div>
            </div>
        </div>
    </div>

