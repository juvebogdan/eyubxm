<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BXM Time Report</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css">
  <!-- AdminLTE Skins.-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/skin-blue.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/all.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>dist/img/27810fa.png" />
    <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/pace/pace.min.css">
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/flash.css">
  <style>
  .panel-footer {
    background-color: #fff !important;
}
.panel-footer h3 {
    font-size: 32px;
}
.panel-footer h4 {
    color: #aaa;
    font-size: 14px;
}
.ajax {
    background-color: #3c8dbc;
    color: #fff;
}
.panel {
    border: 1px solid #f4511e; 
    border-radius:0;
    transition: box-shadow 0.5s;
}
.panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
}
.ajax:hover {
    border: 1px solid #3c8dbc;
    background-color: #fff !important;
    color: #3c8dbc;
}
.panel-heading {
    color: #fff !important;
    background-color: #3c8dbc !important;
    padding: 2px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
}
#overlay {
  z-index: 9999;
  background: rgb(249,249,249);
}
p,label,th,td,li {
  font-size: 17px !important;
}
.dataTables_filter {
   display: none;
}

  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url()?>bxmtime" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url(); ?>dist/img/27810fa.png" alt="Company logo"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Ericsson</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="<?php echo base_url()?>bxmtime/changetoenglish">
                      <h3>
                        Change to English
                      </h3>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="<?php echo base_url()?>bxmtime/changetomontenegrin">
                      <h3>
                        Promijeni na Crnogorski
                      </h3>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        #
                      </h3>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        #
                      </h3>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
            </ul>
          </li>        
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url(); ?>dist/img/user.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $name?></span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>dist/img/user.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name?></p>
        </div>
      </div>