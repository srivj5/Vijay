
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Classifieds</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo admin_source(); ?>/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="<?php echo admin_source(); ?>/plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <link href="<?php echo admin_source(); ?>/css/style.css" rel="stylesheet">
    
</head>
<style type="text/css">
    .error{
        color: #ff5e5e !important;
    }
</style>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html"> <h4>Sign In</h4></a>
        
                                <?php
                                $attributes = array('id'=>'loginuserFrom','autocomplete'=>"off",'class'=>'mt-5 mb-5 login-input');
                                echo form_open($action,$attributes);
                                ?>
                                    <div class="form-group">
                                        <input class="form-control" type="email" placeholder="Enter Your Email Address" name="login_detail">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="Enter Your Password" name="login_password">
                                    </div>
                                    <button class="btn login-form__btn submit w-100" id="submit_btn">Sign In</button>
                                <?php echo form_close();?>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="<?php echo base_url();?>classifieds_admin/user/signup" class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="<?php echo admin_source(); ?>/plugins/common/common.min.js"></script>
    <script src="<?php echo admin_source(); ?>/js/custom.min.js"></script>
    <script src="<?php echo admin_source(); ?>/js/settings.js"></script>
    <script src="<?php echo admin_source(); ?>/js/gleek.js"></script>
    <script src="<?php echo admin_source(); ?>/js/styleSwitcher.js"></script>
    <script src="<?php echo admin_source(); ?>/plugins/toastr/js/toastr.min.js"></script>

    <script src="<?php echo admin_source(); ?>/plugins/validation/jquery.validate.min.js"></script>
</body>
</html>

<script type="text/javascript">
var base_url='<?php echo base_url();?>';
var front_url='<?php echo front_url();?>';

var success = "<?php echo $this->session->flashdata('success')?>";
var error = "<?php echo $this->session->flashdata('error')?>";
if(success!=''){
toastr.success('Classifieds! '+success);
}
if(error!=''){
    toastr.error('Classifieds! '+error);
}
$.validator.addMethod("emailcheck", function(value) {
return (/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/.test(value));
},"Please enter valid email address");
$('#loginuserFrom').validate({
        // errorClass: 'invalid-feedback',
        rules: {
        login_detail: {
        required: true,
        email:true,
        emailcheck: true,
        },
        login_password: {
        required: true
        }
        },
        messages: {
        login_detail: {
        required: "Please enter email",
        email: "Please enter valid email address",
        emailcheck: "Please enter valid email address",
        },
        login_password: {
        required: "Please enter password"
        }
        },
        invalidHandler: function(form, validator) {
          if(!validator.numberOfInvalids())
          {
            return;
          }
          else
          {
            var error_element=validator.errorList[0].element;
            error_element.focus();
          }
        },
        highlight: function (element) {
          //$(element).parent().addClass('error')
        },
        unhighlight: function (element) {
          $(element).parent().removeClass('error')
        },
        submitHandler: function(form) 
        {
        $('#submit_btn').prop('disabled');
        // $('.spinner-border').css('display','inline-block');

                  var $form = $(form);
                  //alert("ddd")
                  form.submit();
          
        }
    });
</script>





