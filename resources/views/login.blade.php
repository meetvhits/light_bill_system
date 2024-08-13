€<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <title>Light Bill System</title>

    <!-- page css -->
    <link href="{{ asset('assets/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/dist/css/style.min.css') }}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-default card-no-border">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Light Bill</p>
        </div>
    </div>
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
            <div class="login-box card">
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif

                    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('loginstore') }}">
                        @csrf
                        <h3 class="text-center m-b-20">Sign In</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="credentails" type="text" placeholder="Enter Email or Phone">
                                @error('credentails')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" placeholder="Enter Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn w-100 btn-lg btn-info btn-rounded text-white" type="submit" name="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
        $(".alert").fadeOut(5000);
    </script>

</body>

</html>
