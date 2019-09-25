<p style="text-align:center;">
    Note: <b>SPACES</b> is not recognized as password.
</p><hr>
<div class="form-group">
        <div class="form-row">
        <div class="col-md-4">
            <label for="firstName" class="col-form-label text-md-right">{{ __('First Name') }}</label>
            <div class="">
                <input id="firstName" pattern=".*\S+.*" title="This field is required." type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ old('firstName') }}" minlength="2" maxlength="30" required>

                @if ($errors->has('firstName'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('firstName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <label for="middleInitial" class="col-form-label text-md-right">{{ __('Middle Initial') }}</label>
            <div class="">
                <input id="middleInitial" pattern=".*\S+.*" title="Don't include a dot after the middle initial." type="text" class="form-control{{ $errors->has('middleInitial') ? ' is-invalid' : '' }}" name="middleInitial" value="{{ old('middleInitial') }}" minlength="1" maxlength="5" >
                @if ($errors->has('middleInitial'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('middleInitial') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <label for="lastName" class="col-form-label text-md-right">{{ __('LastName') }}</label>
            <div class="">
                <input id="lastName" pattern=".*\S+.*" title="This field is required." type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ old('lastName') }}" minlength="2" maxlength="30" required>

                @if ($errors->has('lastName'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
        <div class="col-md-6">
            <label for="username" class="">Username</label>
            <div class="">
                <input id="username" pattern=".*\S+.*" title="This field is required." type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" minlength="6" maxlength="30" required>

                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <label for="role" class="">{{ __('Role') }}</label>
            <div class="">
                <select name="role" id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" required>
                    <option value="Encoder">Encoder</option>
                    <option value="Investigator">Investigator</option>
                    <option value="Administrator">Administrator</option>
                </select>
                @if ($errors->has('role'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('role') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-row">
        <div class="col-md-6">
            <div class="">
                <input id="position" pattern=".*\S+.*" title="This field is required." type="text" placeholder="Position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}" style="display:none" minlength="2" maxlength="10">
                @if ($errors->has('position'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('position') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="">
                <input id="initials" pattern=".*\S+.*" title="This field is required." type="text" placeholder="Initials" class="form-control{{ $errors->has('initials') ? ' is-invalid' : '' }}" name="initials" value="{{ old('initials') }}" minlength="2" maxlength="10" style="display:none">
                @if ($errors->has('initials'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('initials') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-9">
                <label for="password" class="">{{ __('Password') }}</label>
                <div class="from-group">
                    <div class="form-row">
                        <div class="col-md-9">
                            <input id="password" type="text" minlength="8" maxlength="16" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required readonly>
                        </div>
                        <div class="col-md-3">
                            <input type='button' class="form-control btn btn-primary" value ='Generate' onclick='document.getElementById("password").value = Password.generate(12)'>
                        </div>
                    </div>
                </div>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            {{--
            <div class="col-md-5">
                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                <input id="password-confirm"  type="text" minlength="8" maxlength="16" class="form-control" name="password_confirmation" required readonly>
            </div>
             --}}
        </div>
    </div>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
                <div class="">
                    <input type="hidden" id="description" name="description" class="form-control" value="Administrator register new user with the username = ">
                    <input type="hidden" id="action" name="action" class="form-control" value="Add"> {{-- QUERY HERE --}}
                    <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->userid }}">
                </div>
            </div>
        </div>
    </div>
