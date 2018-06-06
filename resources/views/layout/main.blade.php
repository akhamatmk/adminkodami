<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/plugins/images/favicon.png') }}">
      <title>@yield('title')</title>
      <!-- Bootstrap Core CSS -->
      <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Menu CSS -->
      <link href="{{ asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
      <!-- toast CSS -->
      <link href="{{ asset('assets/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
      <!-- morris CSS -->
      <link href="{{ asset('assets/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
      <!-- chartist CSS -->
      <link href="{{ asset('assets/plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
      <!-- Calendar CSS -->
      <link href="{{ asset('assets/plugins/bower_components/calendar/dist/fullcalendar.css') }}" rel="stylesheet" />
      <!-- animation CSS -->
      <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

      <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">
      
      <link href="{{ asset('assets/css/costume.css') }}" rel="stylesheet">
      <!-- color CSS -->
      <link href="{{ asset('assets/css/colors/megna-dark.css') }}" id="theme" rel="stylesheet">

      <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

      <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="fix-header">
      <!-- ============================================================== -->
      <!-- Preloader -->
      <!-- ============================================================== -->
      <!-- Wrapper -->
      <!-- ============================================================== -->
      <div id="wrapper">
         <!-- ============================================================== -->
         <!-- Topbar header - style you can find in pages.scss -->
         <!-- ============================================================== -->
         <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
               <div class="top-left-part">
                  <!-- Logo -->
                  <a class="logo" href="index.html">
                  <b>
                  <img src="{{ asset('assets/plugins/images/admin-logo.png') }}" alt="home" class="dark-logo" />
                  <img src="{{ asset('assets/plugins/images/admin-logo-dark.png') }}" alt="home" class="light-logo" />
                  </b>
                  <span class="hidden-xs">
                  <img src="{{ asset('assets/plugins/images/admin-text.png') }}" alt="home" class="dark-logo" />
                  <img src="{{ asset('assets/plugins/images/admin-text-dark.png') }}" alt="home" class="light-logo" />
                  </span> 
                  </a>
               </div>
               <!-- /Logo -->
               <!-- Search input and Toggle icon -->
               <ul class="nav navbar-top-links navbar-right pull-right">
                  <li>
                     <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                        <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> 
                     </form>
                  </li>
                  <li class="dropdown">
                     <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)"> <img src="{{ asset('assets/plugins/images/users/varun.jpg') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">Steave</b><span class="caret"></span> </a>
                     <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                           <div class="dw-user-box">
                              <div class="u-img"><img src="{{ asset('assets/plugins/images/users/varun.jpg') }}" alt="user" /></div>
                              <div class="u-text">
                                 <h4>Steave Jobs</h4>
                                 <p class="text-muted">varun@gmail.com</p>
                                 <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                              </div>
                           </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> Logout</a></li>
                     </ul>
                     <!-- /.dropdown-user -->
                  </li>
                  <!-- /.dropdown -->
               </ul>
            </div>
         </nav>
         <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav">
               <div class="sidebar-head">
                  <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3>
               </div>
               <ul class="nav" id="side-menu">
                  <li class="user-pro">
                     <a href="javascript:void(0)" class="waves-effect"><img src="{{ asset('assets/plugins/images/users/varun.jpg') }}" alt="user-img" class="img-circle"> <span class="hide-menu"> Steve Gection<span class="fa arrow"></span></span>
                     </a>
                     <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="javascript:void(0)"><i class="ti-user"></i> <span class="hide-menu">My Profile</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-wallet"></i> <span class="hide-menu">My Balance</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-email"></i> <span class="hide-menu">Inbox</span></a></li>
                        <li><a href="javascript:void(0)"><i class="ti-settings"></i> <span class="hide-menu">Account Setting</span></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> <span class="hide-menu">Logout</span></a></li>
                     </ul>
                  </li>

                  @include('layout.menu')                  

               </ul>
            </div>
         </div>
      </div>

      <div id="page-wrapper">
         <div class="container-fluid">

            @yield('content')
         
         </div>
      </div>
      <script src="{{ asset('assets/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>


      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

      <script src="{{ asset('assets/plugins/bower_components/main.js') }}"></script>
      <script src="{{ asset('assets/plugins/bower_components/jquery.maskMoney.js') }}"></script>
      <script src="{{ asset('assets/plugins/bower_components/sweetalert.min.js') }}"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
      <!-- Menu Plugin JavaScript -->
      <script src="{{ asset('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
      <!--slimscroll JavaScript -->
      <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
      <!--Wave Effects -->
      <script src="{{ asset('assets/js/waves.js') }}"></script>
      <!--Counter js -->
      <script src="{{ asset('assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
      <script src="{{ asset('assets/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
      <!--Morris JavaScript -->
      <script src="{{ asset('assets/plugins/bower_components/raphael/raphael-min.js') }}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      
      <script src="{{ asset('assets/js/dropzone.js?v=1') }}"></script>
      
      <!-- chartist chart -->
     <!--  <script src="{{ asset('assets/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script> -->
     
      <!-- Calendar JavaScript -->
      <script src="{{ asset('assets/plugins/bower_components/moment/moment.js') }}"></script>
      <script src="{{ asset('assets/plugins/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/bower_components/calendar/dist/cal-init.js') }}"></script>
      <!-- Custom Theme JavaScript -->
      <script src="{{ asset('assets/js/custom.min.js') }}"></script>
      <script src="{{ asset('assets/js/dashboard1.js?v=5') }}"></script>
      <!-- Custom tab JavaScript -->
      <script src="{{ asset('assets/js/cbpFWTabs.js') }}"></script>
      <script type="text/javascript">
         (function() {
             [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
                 new CBPFWTabs(el);
             });
         })();
      </script>
      <script src="{{ asset('assets/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
      <!--Style Switcher -->
      <script src="{{ asset('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>

      <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
      

      @yield('script')

   </body>
</html>