<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="/dashboard"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
                <li><a href="/word-manager"><i class="fa fa-link"></i>  <span>Word Manager</span></a></li>
                <li><a href="/import-csv"><i class="fa fa-link"></i> <span>Import words</span></a></li>

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row" style="width: 100px;float: right;">
                <!-- /.col -->
                <div class="col-md-12">
                    <a href="/word-manager/add" type="submit" class="btn btn-primary btn-block btn-flat">Add</a>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">


                        <div class="box-header">
                            <h3 class="box-title">Words</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Word</th>
                                    <th>Meaning</th>
                                    <th>Created Date</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($list as $wordEntity)
                                    <tr>
                                    <td>{{$wordEntity['id']}}</td>
                                    <td>{{$wordEntity['word']}}</td>
                                    <td>{{$wordEntity['meaning']}}</td>
                                    <td>{{$wordEntity['created_at']}}</td>
                                    <td style="width: 200px;">
                                        <div class="col-md-6"
                                             style="float: right;">
                                            <a href="/word-manager/edit/{{$wordEntity['id']}}" type="submit"
                                               class="btn btn-success btn-block btn-flat">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="col-md-6"
                                             style="float: right;">
                                            <a href="/word-manager/delete/{{$wordEntity['id']}}" type="submit"
                                               class="btn btn-danger btn-block btn-flat">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Word</th>
                                    <th>Meaning</th>
                                    <th>Created Date</th>
                                    <th>#Action</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous"
                                                id="example1_previous"><a
                                                        href="{{$prevPage}}"
                                                        aria-controls="example1"
                                                        data-dt-idx="0"
                                                        tabindex="0">Previous</a>
                                            </li>

                                            @for ($i = 1; $i <= 10; $i++)

                                            @if($i === $page)
                                            <li class="paginate_button active">
                                                <a href="/word-manager?page={{$i}}"
                                                   aria-controls="example1"
                                                   data-dt-idx="1" tabindex="0">{{$i}}</a>
                                            </li>
                                            @else
                                            <li class="paginate_button ">
                                                <a href="/word-manager?page={{$i}}"
                                                   aria-controls="example1"
                                                   data-dt-idx="1" tabindex="0">{{$i}}</a>
                                            </li>
                                            @endif

                                            @endfor


                                            
                                            <li class="paginate_button next"
                                                id="example1_next"><a href="{{$nextPage}}"
                                                                      aria-controls="example1"
                                                                      data-dt-idx="7"
                                                                      tabindex="0">Next</a>
                                            </li>
                                            <li class="paginate_button next"
                                                id="example1_next"><a href="{{$lastPage}}"
                                                                      aria-controls="example1"
                                                                      data-dt-idx="7"
                                                                      tabindex="0">Last</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3.1.1 -->
<script src="../plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
