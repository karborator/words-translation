<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Translate</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="/translate" method="post">
            <div class="form-group has-feedback">
                <textarea name="words" type="translte_from" class="form-control"
                          placeholder="Type word to translate"></textarea>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4" style="margin-left: 34%;">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Translate</button>
                </div>
                <!-- /.col -->
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

        <div class="form-group has-feedback" style="background: #D2D6DE; margin-top: 10px; height: 70px;">
            @if (isset($translated))
            @if (!is_array($translated))
                $translated = [$translated];
            @endif
            @foreach ($translated as $meanigng)
            <p id="translated_word" style="text-align:center; padding-top: 7%;color: #000000;">{{$meanigng}}</p>
            @endforeach
            @endif
        </div>
    </div>
    <!-- /.login-box-body -->
    <div class="row" style="width: 350px;margin-top: 10px; margin-left: 34%;">
        <!-- /.col -->
        <div class="col-xs-4">
            <a href="/auth" type="submit" class="btn btn-adn btn-block btn-flat">Login</a>
        </div>
    <!-- /.col -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery 3.1.1 -->
<script src="../../plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
