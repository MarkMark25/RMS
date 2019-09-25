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
                    <div class="card" style="padding:7px 8px 5px 8px;background-color:rgba(255, 0, 0, 0.6);">
                        <p>
                            <b>VISION</b>
                            <br>
                            A world-class investigative institution - dynamic, respected and committed to the high ideals of law and order.
                        </p>
                        <p>
                            <b>MISSION</b>
                            <br>
                            To provide quality investigative and forensic services to the people through advanced methods and equipment in the pursuit of truth and justice.
                        </p>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <!--EDIT HERE -->
                <div class="col-md-4" style="height:30vw;">
                    <div class="card card-login mx-auto mt-5 col-md-auto" style="background-color:rgba(255, 0, 0, 0.6);opacity:1;">
                        <div class="card-body">
                            <center>
                                <img src="bower_components/image/logInLogo.png" alt="Log In Icon" height="80"></img> {{-- RESIZE IMAGE --}}
                            </center>
                            <form >
                                <br>
                            <div class="form-group">
                                <div class="form-label-group">
                                <input type="text" id="inputUsername" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                                <label for="inputUsername">Username</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                <input type="password" minlength="8" maxlength="16" id="inputPassword" class="form-control" placeholder="Password" required="required">
                                <label for="inputPassword">Password</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="remember-me">
                                    Accept the <a href="#" data-toggle="modal" data-target="#termsConditionModal">Terms and Conditions.</a>
                                </label>
                                </div>
                            </div>
                            <center>
                                <a class="btn btn-primary btn-block" href="">Login</a> {{-- LINK HERE --}}
                            </center>
                            </form>
                            <div class="text-left">
                                <br>
                            <a class="d-block small" href="#" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</a> {{-- LINK HERE --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--END OF THE CONTAINER-->

    <!-- Terms and Condition Modal-->
    <div class="modal fade" id="termsConditionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">NBI-CAR Terms and Condition</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        </div>
      </div>
    </div>

    <!-- Forgot Password Modal-->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">NBI-CAR Terms of Password</h5>
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
