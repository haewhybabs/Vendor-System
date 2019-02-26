<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from themes-lab.com/make/admin/layout1/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 May 2018 16:20:29 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/global/images/logo/new_logo.jpg" type="image/png">
    <title><?php echo $title; ?></title>
    <link href="<?= base_url(); ?>assets/global/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/global/css/theme.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/global/css/ui.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/admin/layout1/css/layout.css" rel="stylesheet">
    <!-- BEGIN PAGE STYLE -->
    <link href="<?= base_url(); ?>assets/global/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/global/plugins/maps-amcharts/ammap/ammap.css" rel="stylesheet">
     <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">


     
    <script src="<?= base_url(); ?>assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
    <style>
        .noty_message{display: none;}
        .e-title{
            float: left;
    padding: 10px 20px;
    font-size: 20px;
        }
    </style>    <!-- END PAGE STYLE -->
    <script src="<?= base_url(); ?>assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <!-- THEME COLOR: Apply "color-blue" for blue color: #4A89DC -->
  <!-- BEGIN BODY -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default dashboard">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <?php  
        $page=$this->router->fetch_method();
        $url=$this->router->fetch_class();
        $login=$this->session->userdata('logged_in');
         // print_r($login);
         $email=$login['email']; 
         $first_name=$login['firstname']; 
         $last_name=$login['lastname'];
        $admin_id=$login['admin_id'];
       
     ?>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
            <a href="<?= site_url(); ?>"><img src="<?= base_url();?>/assets/global/images/logo/new_logo.jpg" style="position: absolute;top: -27px;width: 75px;margin: 18px 20%;"></a>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users"></i>
              <div class="user-details">
                <h4><?= $first_name.' '.$last_name ?></h4>
                <div class="dropdown user-login">
                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                  <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <ul class="nav nav-sidebar">
            <li class=""><a href="<?= site_url('') ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>
           <!-- ONLY FOR ADMIN-->
               
             <li class="nav-parent <?php if($url=='department' || $url=='mail' || $url=='users' || $url=='announcement' || $url=='category'){echo 'nav-active active';} ?>">
              <a href="#"><i class="icon-settings"></i><span>Settings</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
            
               <li <?php if($page=='mail'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('') ?>"><i class="fa fa-envelope"></i><span>Mail setting</span></a>
                  </li>
                  
                  <li <?php if($page=='index' && $url=='category'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('category') ?>"><i class="icons-education-science-18"></i><span>Service Category</span></a>
                  </li>
                  
                 <li <?php if($page=='announcement'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('') ?>"><i class="icons-education-science-18"></i><span>Announcement</span></a>
                  </li>
                  
              <li <?php if($page=='index' && $url=='department'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('department') ?>"><i class="icons-education-science-18"></i><span>Department</span></a>
                  </li>
               <li <?php if($page=='create'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('department/create') ?>"><i class="icons-documents-bookmarks-15"></i><span>Create department</span></a>
                  </li>
                  
                   <li <?php if($page=='lists'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('users/lists') ?>"><i class="fa fa-group"></i><span>Users</span></a>
                  </li>
                  
                   <li <?php if($page=='create'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('users/create') ?>"><i class="fa fa-user"></i><span>Create user</span></a>
                  </li>
              </ul>
            </li>
         
            <li class="nav-parent <?php if($url=='vendor'){echo 'nav-active active';} ?>">
                <a href="#"><i class="icon-user"></i><span>Vendor</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li <?php if($page=='index' || $page=='schedule'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('vendor'); ?>"><i class="icon-user"></i><span>New vendors</span></a>
                </li>
                <li  <?php if($page=='approve' || $page=='approve_list'){echo 'class="active"';} ?>>
                <a href="<?= site_url('vendor/approve_list'); ?>"><i class="icon-user"></i><span>Approved vendors</span></a>
                </li>
                <li  <?php if($page=='reject' || $page=='reject_list'){echo 'class="active"';} ?>>
                <a href="<?= site_url('vendor/reject_list'); ?>"><i class="icon-user"></i><span>Rejected vendors</span></a>
                </li>
                <li <?php if($page=='interview'){echo 'class="active"';} ?>>
                <a href="<?= site_url('vendor/interview'); ?>"><i class="icon-user"></i><span>Interview vendors</span></a>
                </li>
              </ul>
            </li>
        <?php  ?>
        <!-- ONLY FOR ADMIN-->
        <!-- ONLY FOR REQUISITION-->  
          
             <li class="nav-parent <?php if($url=='requisition'){echo 'nav-active active';} ?>">
              <a href="#"><i class="icon-picture"></i><span>Requisition</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
               <h5 class="text-center">Department</h5>
                <li <?php if($page=='index' || $page=='create'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('requisition/create'); ?>"><i class="icon-user"></i><span>Create Requisition</span></a>
                </li>
                <li  <?php if($page=='lists'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/lists'); ?>"><i class="icon-user"></i><span>My Requisitions</span></a>
                </li>
                <!-- ONLY FOR ADMIN-->
                <h5 class="text-center">Department Head</h5>
                <?php  if(in_array(1, $arry_select2)) {?> 
                <li  <?php if($page=='concur'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/concur'); ?>"><i class="icon-user"></i><span>Concur Requisition</span></a>
                </li>
                <li  <?php if($page=='store'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/store'); ?>"><i class="icon-user"></i><span>Store</span></a>
                </li>
                 <h5 class="text-center">Technical review</h5>
                <li  <?php if($page=='review_service'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/review_service'); ?>"><i class="icon-user"></i><span>Review Requisition</span></a>
                </li>
                 <h5 class="text-center">Church Administrator</h5>
                <li  <?php if($page=='requisition_list'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/requisition_list'); ?>"><i class="icon-user"></i><span>New Requisition</span></a>
                </li>
                <li  <?php if($page=='approve_list'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/approve_list'); ?>"><i class="icon-user"></i><span>Approved Requisition</span></a>
                </li>
                <li  <?php if($page=='reject_list'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/reject_list'); ?>"><i class="icon-user"></i><span>Un-approved Requisition</span></a>
                </li>
                 <?php }  ?>
                 <!-- ONLY FOR ADMIN-->
              </ul>
            </li>
        
         <!-- ONLY FOR REQUISITION-->
      
                 <li class="nav-parent <?php if($url=='request'){echo 'nav-active active';} ?>">
              <a href="#"><i class="icon-picture"></i><span>Request For Quotes</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li  <?php if($page=='quote_lists'){echo 'class="active"';} ?>>
                <a href="<?= site_url('request/quote_lists'); ?>"><i class="icon-user"></i><span>Approved For Quotes</span></a>
                </li>
                <li  <?php if($page=='index'){echo 'class="active"';} ?>>
                <a href="<?= site_url('request'); ?>"><i class="icon-user"></i><span>Sent Quotes</span></a>
                </li>
            
              </ul>
            </li>
          
           <!-- ONLY FOR REQUISITION-->
            <li class="nav-parent <?php if($url=='request'){echo 'nav-active active';} ?>">
              <a href="#"><i class="icon-picture"></i><span>Request For Proposal</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li  <?php if($page=='proposal_lists'){echo 'class="active"';} ?>>
                <a href="<?= site_url('request/proposal_lists'); ?>"><i class="icon-user"></i><span>Approved For proposals</span></a>
                </li>
                <li  <?php if($page=='sent_proposal'){echo 'class="active"';} ?>>
                <a href="<?= site_url('request/sent_proposal'); ?>"><i class="icon-user"></i><span>Sent Proposal</span></a>
                </li>
                
              </ul>
            </li>
        
                 <li class="nav-parent">
              <a href="#"><i class="icon-picture"></i><span>Quote from Vendor</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                   <li  <?php if($page==''){echo 'class="active"';} ?>>
                <a href="<?= site_url('quotes/lists'); ?>"><i class="icon-user"></i><span>Received Request</span></a>
                </li>
                  <li  <?php if($page==''){echo 'class="active"';} ?>>
                      <a href="<?= site_url('quotes/set_price'); ?>"><i class="icon-user"></i><span>Quote Price</span></a>
                  </li>
                <li  <?php if($page==''){echo 'class="active"';} ?>>
                <a href="<?= site_url('quotes/lists'); ?>"><i class="icon-user"></i><span>Late Submitted Request</span></a>
                </li>
              </ul>
            </li>

              <li class=""><a href="<?= site_url('budget_control') ?>"><i class="icon-home"></i><span>Budget Control</span></a></li>
              <li class=""><a href="<?= site_url('dfs') ?>"><i class="icon-home"></i><span>Dfs</span></a></li>
              <li class=""><a href="<?= site_url('Forensic') ?>"><i class="icon-home"></i><span>Forensic</span></a></li>
              <li class=""><a href="<?= site_url('rp') ?>"><i class="icon-home"></i><span>RP</span></a></li>
              <li class=""><a href="<?= site_url('invoices') ?>"><i class="icon-home"></i><span>Invoices</span></a></li>
         
            <li class="nav-parent">
              <a href="#"><i class="icon-picture"></i><span>Proposal from Vendor</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                   <li  <?php if($page==''){echo 'class="active"';} ?>>
                <a href="<?= site_url('/lists'); ?>"><i class="icon-user"></i><span>Received Request</span></a>
                </li>
                <li  <?php if($page==''){echo 'class="active"';} ?>>
                <a href="<?= site_url('request/lists'); ?>"><i class="icon-user"></i><span>Late Submitted Request</span></a>
                </li>
              </ul>
            </li>
        
            <li class="nav-parent">
              <a href="#"><i class="icon-picture"></i><span>POS</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
               <li  <?php if($page=='lists'){echo 'class="active"';} ?>>
                <a href="<?= site_url('request/requisitions'); ?>"><i class="icon-user"></i><span>Approved Requisitions</span></a>
                </li>
              </ul>
            </li>
       
         <li class="nav-parent">
              <a href="#"><i class="icon-picture"></i><span>Auditing</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
              <li <?php if($page=='index' || $page=='create'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('requisition/create'); ?>"><i class="icon-user"></i><span>Requisitions</span></a>
                </li>
                <li  <?php if($page=='lists'){echo 'class="active"';} ?>>
                <a href="<?= site_url('requisition/lists'); ?>"><i class="icon-user"></i><span>Vendors</span></a>
                </li>
              </ul>
            </li>
          
                  <li <?php if($page=='change_password'){echo 'class="active"';} ?>>
                    <a href="<?= site_url('users/change_password'); ?>"><i class="fa fa-edit"></i><span>Change Password</span></a>
                  </li>
                  <li>
                    <a href="<?= site_url('home/logout'); ?>"><i class="icon-power"></i><span>Log out</span></a>
                  </li> 
           
          </ul>
          
          <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
            <i class="icon-settings"></i></a>
            <a class="pull-left btn-effect" href="<?= site_url('home/logout'); ?>" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
        
         <h6 class="e-title"><a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span class="fa fa-align-justify"></span></span></a> &nbsp;&nbsp; e-Procurement Portal</h6>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
             <li></li>
              <!-- END USER DROPDOWN -->
              <!-- BEGIN NOTIFICATION DROPDOWN -->
             
              <!-- END NOTIFICATION DROPDOWN -->
              
              <!-- END MESSAGES DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <!--img src="<?= base_url(); ?>assets/global/images/avatars/user1.png" alt="user image"-->
                <span class="username">Welcome,  <?= $department_status->dept_name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#"><i class="icon-user"></i><span>My Profile</span></a>
                  </li>
                 
                  <li>
                    <a href="#"><i class="icon-settings"></i><span>Account Settings</span></a>
                  </li>
                  <li>
                    <a href="<?= site_url('home/logout'); ?>"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
              
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
        
        <?php echo $body; ?>
        
        </div>
        <!-- END PAGE CONTENT -->
       
      </div>
      <!-- END MAIN CONTENT -->
      <hr>
       <div class="footer">
            <div class="copyright">
              <p class="text-center">
                <span>Copyright <span class="copyright">©</span> <?= date('Y'); ?> </span>
                <span>Living Faith Church</span>.
                <span>All rights reserved. </span>
              </p>
              
            </div>
          </div>
    </section>
  
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="<?= base_url(); ?>assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/gsap/main-gsap.min.js"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/tether/js/tether.min.js"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/appear/jquery.appear.js"></script>
    <script src="<?= base_url(); ?>assets/global/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="<?= base_url(); ?>assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="<?= base_url(); ?>assets/global/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="<?= base_url(); ?>assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="<?= base_url(); ?>assets/global/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
    <script src="<?= base_url(); ?>assets/global/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="<?= base_url(); ?>assets/global/plugins/select2/dist/js/select2.full.min.js"></script> <!-- Select Inputs -->
    <script src="<?= base_url(); ?>assets/global/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="<?= base_url(); ?>assets/global/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
    <script src="<?= base_url(); ?>assets/global/js/builder.js"></script> <!-- Theme Builder -->
    <script src="<?= base_url(); ?>assets/global/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="<?= base_url(); ?>assets/global/js/application.js"></script> <!-- Main Application Script -->
    <script src="<?= base_url(); ?>assets/global/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="<?= base_url(); ?>assets/global/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="<?= base_url(); ?>assets/global/js/quickview.js"></script> <!-- Chat Script -->
    <script src="<?= base_url(); ?>assets/global/js/pages/search.js"></script> <!-- Search Script -->
    <script src="<?= base_url(); ?>assets/global/plugins/step-form-wizard/js/reg.js"></script>
    <!-- BEGIN PAGE SCRIPT -->
    <script src="<?= base_url(); ?>assets/global/plugins/metrojs/metrojs.min.js"></script> <!-- Flipping Panel -->
    <script src="<?= base_url(); ?>assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script> <!-- Inline Edition X-editable -->
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> <!-- Context Menu -->
    <script src="<?= base_url(); ?>assets/global/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
    <script src="<?= base_url(); ?>assets/global/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
    <script src="<?= base_url(); ?>assets/global/plugins/charts-highstock/js/highstock.js"></script> <!-- financial Charts -->
    <script src="<?= base_url(); ?>assets/global/plugins/charts-highstock/js/modules/exporting.js"></script> <!-- Financial Charts Export Tool -->
    <script src="<?= base_url(); ?>assets/global/plugins/maps-amcharts/ammap/ammap.js"></script> <!-- Vector Map -->
    <script src="<?= base_url(); ?>assets/global/plugins/maps-amcharts/ammap/maps/js/worldLow.js"></script> <!-- Vector World Map  -->
    <script src="<?= base_url(); ?>assets/global/plugins/maps-amcharts/ammap/themes/black.js"></script> <!-- Vector Map Black Theme -->
    <script src="<?= base_url(); ?>assets/global/plugins/skycons/skycons.min.js"></script> <!-- Animated Weather Icons -->
    <script src="<?= base_url(); ?>assets/global/plugins/simple-weather/jquery.simpleWeather.js"></script> <!-- Weather Plugin -->
    <script src="<?= base_url(); ?>assets/global/js/widgets/todo_list.js"></script>
    <script src="<?= base_url(); ?>assets/global/js/widgets/widget_weather.js"></script>
    <script src="<?= base_url(); ?>assets/global/js/pages/dashboard.js"></script>
    
     <!-- BEGIN PAGE SCRIPT -->
    <script src="<?= base_url(); ?>assets/global/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script> <!-- A mobile and touch friendly input spinner component for Bootstrap -->
    <script src="<?= base_url(); ?>assets/global/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script> <!-- Time Picker -->
    <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> <!-- >Bootstrap Date Picker -->
    
   <!-- BEGIN PAGE SCRIPTS -->
    <script src="<?= base_url(); ?>assets/global/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="<?= base_url(); ?>assets/global/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/global/js/pages/table_dynamic.js"></script>
   
    <!-- END PAGE SCRIPT -->
    <script src="<?= base_url(); ?>assets/admin/layout1/js/layout.js"></script>
    
    <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
 
  <script>
    $('.b-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });  
      
    </script>
    
<script>
$(document).ready(function(){  
    setInterval(function(){
     $.ajax({
            url: "<?php echo base_url();?>index.php/enrollee/get_state/",
            cache: false,
            success: function (html) {
                $("#results").text(html);
            },
    });
},2000);
});
</script>

 <script>
              $('#table_2').dataTable( {
                  "pageLength": 25
                } );
            </script>
  </body>

<!-- Mirrored from themes-lab.com/make/admin/layout1/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 May 2018 16:22:57 GMT -->
</html>

