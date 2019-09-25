<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NBI-CAR</title>

    <!-- Bootstrap core CSS-->
    <link href="bower_components/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="bower_components/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="bower_components/css/sb-admin.css" rel="stylesheet">

    <!--TAB IMAGE -->
    <link rel="icon"  href="bower_components/image/nbi-logo.png">

  </head>

  <body class="bg-dark background-image">

    <div class="container">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-7 mt-2 col-md-auto">
                                <img src="bower_components/image/nbi-logo.png" alt="NBI Logo" height="250"></img> {{-- RESIZE IMAGE --}}
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding:7px 8px 5px 8px;background-color:#b8c2cb;">
                        <p>
                            <b>VISION</b>
                            <br>
                            {{--
                            @foreach ($vision as $vision)
                                {{ $vision->vision }}
                            @endforeach
                             --}}
                            A world-class investigative institution - dynamic, respected and committed to the high ideals of law and order.
                        </p>
                        <p>
                            <b>MISSION</b>
                            <br>
                            {{--
                            @foreach ($mission as $mission)
                                {{ $mission->mission }}
                            @endforeach
                             --}}
                            To provide quality investigative and forensic services to the people through advanced methods and equipment in the pursuit of truth and justice.
                        </p>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <!--EDIT HERE -->
                <div class="col-md-4" style="height:30vw;">
                    <div class="card card-login mx-auto mt-5 col-md-auto" style="background-color:#E9ECEF;opacity:1;">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <center>
                                    <img src="bower_components/image/logInLogo1.png" alt="Log In Icon" height="auto" width="50%"></img> {{-- RESIZE IMAGE --}}
                                </center>
                            <div class="form-group">
                                <div class="form-label-group">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                <label for="inputPassword">{{ __('Username') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                <label for="inputPassword">{{ __('Password') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="remember-me" checked="false" oninvalid="this.setCustomValidity('Please read the term and conditions, then click the checkbox if you want to proceed.')" onchange="this.setCustomValidity('')" required >
                                    Accept the <a href="#" data-toggle="modal" data-target="#termsConditionModal">Terms and Conditions.</a>
                                </label>
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </center>
                            </form>
                            <div class="text-left">
                                <br>
                            <a class="d-block small" href="#" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--END OF THE CONTAINER-->



    <!-- Terms and Condition Modal-->
    <div class="modal fade" id="termsConditionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>NBI-CAR Terms and Condition</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                If you continue to browse and use this website, you are agreeing to comply with and be bound by the following <b>terms and conditions</b> of use, which together with our privacy policy govern <b>NBI-CAR</b> relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use this website.
            </p>
            <p>
                <b>The use of this website is subject to the following terms of use:</b>
                <ul>
                    <li>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>
                    <li>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>
                    <li>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any information available through this website meet your specific requirements.</li>
                    <li>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>
                    <li>All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.</li>
                    <li><b>Unauthorised</b> use of this website may give rise to a claim for damages and/or be a criminal offence.</li>
                    <li>From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>
                    <li>Your use of this website and any dispute arising out of such use of the website is subject to the laws of the Philippines.</li>
                </ul>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Forgot Password Modal-->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>NBI-CAR Terms of Password</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <b>Contact the administrator</b>
              <br>
              <p>
                  Please go to the administrator building to reset your password. Only the Administrator can reset your password.
              </p>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="bower_components/vendor/jquery/jquery.min.js"></script>
    <script src="bower_components/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="bower_components/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
