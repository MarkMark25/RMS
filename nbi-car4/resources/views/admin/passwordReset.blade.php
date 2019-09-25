<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="userName">Username</label>
            <div class="">
                <input type="text" id="username" name="username" class="form-control" value="" readonly>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-6">
            <label for="firstName">First name</label>
            <div class="">
            <input type="text" id="firstName" name="firstName" class="form-control" value="" disabled>
            </div>
        </div>
        <div class="col-md-6">
            <label for="lastName">Last name</label>
            <div class="">
            <input type="text" id="lastName" name="lastName" class="form-control" value="" disabled>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col-md-9">
            <label for="password">Password</label>
            <div class="">
            <input type="text" id="p"  name="password" class="form-control" value="" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <label for="">Click</label>
            <div class="">
                    <input type='button' class="form-control btn btn-primary" value ='Generate' onclick='document.getElementById("p").value = Password.generate(16)'>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <div class="">
                    <input type="hidden" id="description" name="description" class="form-control" value="Administrator reset user password, with the username = ">
                    <input type="hidden" id="action" name="action" class="form-control" value="Update"> {{-- QUERY HERE --}}
                    <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                </div>
            </div>
        </div>
    </div>

