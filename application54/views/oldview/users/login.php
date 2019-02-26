<!DOCTYPE html>
<html>
    
<!-- Mirrored from themes-lab.com/make/admin/layout1/user-login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 May 2018 16:26:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8">
        <title>Living Faith Admin Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
      <link rel="shortcut icon" href="<?= base_url(); ?>assets/global/images/logo/new_logo.jpg" type="image/png">
        <link href="<?= base_url(); ?>assets/global/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/global/css/ui.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    </head>
    <body class="account2" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
            <div class="text-center"><img src="<?= base_url(); ?>assets/global/images/logo/new_logo.jpg" style="margin:auto"></div>
            
            <div class="account-form">
                <form class="form-signin" role="form" action="<?= site_url('home/login') ?>" method="post">
                   <?php
                     if ($this->session->userdata('error') <> '') {
                        echo '<div class="alert alert-dismissable alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                 <p>' . $this->session->userdata("error") . '</p>
                            </div>';
                    }?>
                    <h3><strong>Log in</strong> to your account</h3>
                    
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
                   <div style="margin-top:10px"><button type="submit" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left">Sign In</button></div> 
                    <span class="forgot-password"><a id="password" href="account-forgot-password.html" >Forgot password?</a></span>
                    <div class="form-footer">
                       
                        <div class="clearfix">
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
                    </div>
                </form>

            </div>
           
        </div>
        <!-- END LOCKSCREEN BOX -->
        <p class="account-copyright">
            <span>Copyright © <?= date('Y'); ?> </span><span>Living Faith Church</span>.<span> All rights reserved.</span>
        </p>
       <script src="<?= base_url(); ?>assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/gsap/main-gsap.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/tether/js/tether.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/backstretch/backstretch.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="<?= base_url(); ?>assets/global/js/pages/login-v2.js"></script>
    </body>

<!-- Mirrored from themes-lab.com/make/admin/layout1/user-login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 May 2018 16:26:28 GMT -->
</html>