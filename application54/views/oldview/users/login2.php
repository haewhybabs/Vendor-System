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
    <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    <!-- BEGIN PAGE STYLE -->
    <link href="<?= base_url(); ?>assets/global/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/global/plugins/maps-amcharts/ammap/ammap.css" rel="stylesheet">
    <style>
        .bg-dark:not(i) {
    background-color: #b3b4b3 !important;
    color: #fff !important;
}
        .account2 .form-footer {
        background: #fff; 
        }
        .noty_message{display: none;}
        .fixed-topbar .topbar {
       background: #2b2e33 !important;
    height: 100px;
    position: fixed;
    top: 0;
    right: 0;
            left: 0;}
    .main-content {
    background: #F5F5F5;
    margin-left: 0px;
        margin-top: 100px;;
    min-height: 750px;
    }
    .main-content .page-content .panel .panel-header h2 {
    font-size: 14.5px;
        }
        
        .tit{
          margin-top: 30px;
            font-size: 23px; 
            color: #fff;
        }
        
    @media (min-width: 768px){
    	.account2 .account-form {
           width: 100%;
            margin: 0;
                }
            .account2 .container {
            margin: auto;
            position: relative;
            width: 100%;
        }
        }
        
         @media (max-width: 768px){
         .tit{
          margin-top: -61px;
            text-align: center;
            font-size: 17px;
            color: #fff;
        }
        }
        
         @media (max-width: 500px){
         .tit{
         margin-top: -61px;
    text-align: center;
    font-size: 15px;
    padding-left: 108px;
    color: #fff;
        }
        }
    </style>    <!-- END PAGE STYLE -->
    <script src="<?= base_url(); ?>assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <!-- THEME COLOR: Apply "color-blue" for blue color: #4A89DC -->
  <!-- BEGIN BODY -->
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default dashboard account2" data-page="login" style="background:#fff">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
            
     <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
         <div class="col-sm-4"><img src="<?= base_url(); ?>assets/global/images/logo/new_logo.jpg" style="height:100px">
         
        
         </div>
         <div class="col-sm-8 tit">Living Faith Church Vendor Registration Portal</div>
          <!--div class="header-right">
            <ul class="header-menu nav navbar-nav">
                  <li>
                    <a href="#"><i class="icon-settings"></i><span>Account Settings</span></a>
                  </li>
                  <li>
                    <a href="#"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
               </ul>
          </div-->
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
             
            <div class="col-sm-12"> 
            <?php
             if ($this->session->userdata('error') <> '') {
                echo '<div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <p>' . $this->session->userdata("error") . '</p>
                    </div>';
            }
             if ($this->session->userdata('message') <> '') {
                echo '<div class="alert alert-dismissable alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <p>' . $this->session->userdata("message") . '</p>
                    </div>';
            }
            ?>
            </div>
             <div class="col-md-4">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>LOGIN</strong> Here</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="container" id="login-block">  
            <div class="account-form">
                <form class="form-signin" role="form" action="<?= site_url('home/login') ?>" method="post">

                    <div class="append-icon">
                        <input type="text" name="email" id="name" class="form-control form-white username" placeholder="Username">
                        <i class="icon-user"></i>
                    </div>
                      <span class="text-danger"><?php echo form_error('email'); ?></span>
                    <div class="append-icon">
                        <input type="password" name="password" class="form-control form-white password" placeholder="Password">
                        <i class="icon-lock"></i>
                    </div>
                     <span class="text-danger"><?php echo form_error('password'); ?></span>
                   <div style="margin-top:10px"><button type="submit" class="btn btn-lg btn-danger btn-rounded ladda-button" data-style="expand-left">Sign In</button></div> 
                    <span class="forgot-password"><a id="password" href="account-forgot-password.html" >Forgot password?</a></span>
                    <div class="form-footer">
                       
                        <div class="clearfix">
                            <p class="new-here">New Vendor? &nbsp; <a href="<?= site_url('registration'); ?>" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left" style="color: #fff;">Register</a></p>
                        </div>
                    </div>
                </form>
                <form class="form-password" role="form" action="<?= site_url('home/password') ?>" method="post">
                    <h3><strong>Reset</strong> your password</h3>
                    <span class="text-danger"><?php echo form_error('remail'); ?></span>
                    <div class="append-icon m-b-20">
                        <input type="text" name="remail" class="form-control form-white password" placeholder="Enter Registered Email">
                        <i class="icon-lock"></i>
                    </div>
                    <button type="submit" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Send Password</button>
                    <div class="clearfix m-t-60">
                        <p class="pull-left m-t-20 m-b-0"><a id="login" href="#">Have an account? Sign In</a></p>
                        <p class="pull-right m-t-20 m-b-0"><a href="<?= site_url('registration'); ?>">New here? Sign up</a></p>
                    </div>
                </form>
            </div>
           
        </div>
                </div>
              </div>
            </div>
            
             <div class="col-md-4">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>ANNOUNCEMENT</strong></h2>
                </div>
                <div class="panel-body bg-white">
                    <?php $num=0; foreach($news as $new){
                      if($num <= 10){
                      ?>

                      <div>
                        <p><?= $new->summary;?></p>
                        <small class="text-danger"><em><?= $new->date_added; ?></em></small>
                        <a href="#" data-toggle="modal" data-target="#modal-basic<?= $new->id; ?>" class="btn btn-danger btn-sm" style="float:right">Read More</a>
                        <hr>
                      </div>
                       <div class="modal fade" id="modal-basic<?= $new->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                          <h4 class="modal-title"><strong><?= $new->summary;?></strong></h4>
                        </div>
                        <div class="modal-body">
                         <div class="col-sm-12">
                            <p><?= $new->content;?></p>
                         </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                          </div> 
                    <?php } $num++; } ?>
                </div>
              </div>
            </div>
            
             <div class="col-md-4">
              <div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>TWITTER</strong> FEED</h2>
                </div>
                <div class="panel-body bg-white">
                <a class="twitter-timeline" href="https://twitter.com/livingfaithota?ref_src=twsrc%5Etfw">Tweets by livingfaithota</a> 
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>
              </div>
            </div>
            
             <div class="footer" style="clear:both">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
               <span>Copyright © <?= date('Y'); ?> </span><span>Living Faith Church</span>.<span> All rights reserved.</span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
       
      </div>
      <!-- END MAIN CONTENT -->
    </section>
  
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="<?= base_url(); ?>assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
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
     <script src="<?= base_url(); ?>assets/global/plugins/backstretch/backstretch.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/js/pages/login-v2.js"></script>
     <!-- BEGIN PAGE SCRIPTS -->
   
    <!-- END PAGE SCRIPT -->
    <script src="<?= base_url(); ?>assets/admin/layout1/js/layout.js"></script>
  </body>

<!-- Mirrored from themes-lab.com/make/admin/layout1/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 May 2018 16:22:57 GMT -->
</html>

