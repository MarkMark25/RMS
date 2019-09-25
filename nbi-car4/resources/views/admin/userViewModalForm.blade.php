<div class="form-group">
        <div class="form-row">
        <div class="col-md-5">
            <label for="firstName">First name</label>
            <div class="">
            <input type="text" pattern=".*\S+.*" title="This field is required." id="firstName" name="firstName" class="form-control" value="" maxlength="50" disabled> {{-- QUERY HERE --}}
            </div>
        </div>
         <div class="col-md-2">
        <label for="mid">Middle Initial</label>
        <div class="">
        <input type="text" pattern=".*\S+.*" id="middleInitial" name="middleInitial" class="form-control" value="" maxlength="5" disabled> {{-- QUERY HERE --}}
        </div>
    </div>
        <div class="col-md-5">
            <label for="lastName">Last name</label>
            <div class="">
            <input type="text" pattern=".*\S+.*" title="This field is required." id="lastName" name="lastName" class="form-control" value="" maxlength="50" disabled> {{-- QUERY HERE --}}
            </div>
        </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
        <div class="col-md-6">
            <label for="userName">Username</label>
            <div class="">
            <input type="text" pattern=".*\S+.*" title="This field is required." id="username" name="username" class="form-control" value="" maxlength="50" disabled> {{-- QUERY HERE --}}
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
                <input type="text" id="userStatus" name="userStatus" class="form-control" value="" disabled> {{-- QUERY HERE --}}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
                <label for="">Date Encoded</label>
                <input type="text" id="dEncoded" name="dEncoded" class="form-control" value="" disabled>
            </div>
            <div class="col-md-6">
                <label for="">Date Updated</label>
                <input type="text" id="dUpdated" name="dUpdated" class="form-control" value="" disabled>
            </div>
        </div>
    </div>

