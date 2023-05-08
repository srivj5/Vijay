<?php $this->load->view('admin/header');
?>
<style type="text/css">
    .error{
        color: #ff5e5e !important;
    }
</style>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <?php
                                $attributes = array('id'=>'edit_reg_form','autocomplete'=>"off",'class'=>'form-valide');
                                echo form_open_multipart($action,$attributes);
                                ?>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Category <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="category" name="category" placeholder="Enter a category.." value="<?php echo $register->category; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Title <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title.." value="<?php echo $register->title; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Arabic Title <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="arabic_title" name="arabic_title" placeholder="Enter a arabic title.." value="<?php echo $register->arabic_title; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Logo <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control" id="logo_file" name="logo_file">
                                                <?php $im = $register->logo; ?>
                                                <input type="hidden" name="oldimage" id="oldimage" value="<?php echo $register->logo; ?>" />
                                                <?php if($register->logo!='') { ?>
                                                <img src="<?php echo $im; ?>" style="width:65px;height:65px;" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Contract <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="contract" name="contract" placeholder="Enter a contract.." value="<?php echo $register->contract; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Featured <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="feature" name="feature" placeholder="Enter a feature.." value="<?php echo $register->feature; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Address <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" id="address" name="address" rows="5" placeholder="Enter a address.."><?php echo $register->address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Map <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="map" name="map" placeholder="Enter a map.." value="<?php echo $register->map; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Phone<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter a phone no.." value="<?php echo $register->phone; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Email <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter a Email.." value="<?php echo $register->email; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Facebook <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter a facebook id.." value="<?php echo $register->facebook; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Instagram <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Enter a instagram id.." value="<?php echo $register->instagram; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Website <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="website" name="website" placeholder="http://example.com" value="<?php echo $register->website; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="password" name="password" placeholder="Enter a password.." value="<?php echo $register->password; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Email Verification <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="email_verify" name="email_verify">
                                                    <option value="">Please select</option>
                                                    <option <?php if($register->email_verification==1){echo 'selected';}?> value="1">Verified</option>
                                                    <option <?php if($register->email_verification==0){echo 'selected';}?> value="0">Not Verified</option>        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="">Please select</option>
                                                    <option <?php if($register->status==1){echo 'selected';}?> value="1">Enable</option>
                                                    <option <?php if($register->status==0){echo 'selected';}?> value="0">Disable</option>        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
               <?php $this->load->view('admin/footer');
?>
        <!--**********************************
            Footer end
        ***********************************-->
        <script src="<?php echo admin_source(); ?>/plugins/validation/jquery.validate.min.js"></script>


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
$('#edit_reg_form').validate({
        // errorClass: 'invalid-feedback',
        rules: {
        category: {
        required: true,        
        },
        title: {
        required: true
        },
        arabic_title: {
        required: true
        },        
        contract: {
        required: true
        },
        feature: {
        required: true
        },
        address: {
        required: true
        },
        map: {
        required: true
        },
        phone: {
        required: true,
        number: true
        },
        email: {
        required: true,
        email:true,
        emailcheck: true,
        },
        facebook: {
        required: true
        },
        instagram: {
        required: true
        },
        website: {
        required: true
        },
        password: {
        required: true
        },
        email_verify: {
        required: true
        },
        status: {
        required: true
        }
        },
        messages: {
        category: {
        required: "Please enter category"
        },
        title: {
        required: "Please enter title"
        },
        arabic_title: {
        required: "Please enter arabic_title"
        },
        contract: {
        required: "Please enter contract"
        },
        feature: {
        required: "Please enter feature"
        },
        address: {
        required: "Please enter address"
        },
        map: {
        required: "Please enter map"
        },
        phone: {
        required: "Please enter phone",
        number: "Please enter a valid number"
        },
        email: {
        required: "Please enter email",
        email: "Please enter valid email address",
        emailcheck: "Please enter valid email address",
        },
        facebook: {
        required: "Please enter facebook"
        },
        instagram: {
        required: "Please enter instagram"
        },
        website: {
        required: "Please enter website"
        },
        password: {
        required: "Please enter password"
        },
        email_verify: {
        required: "Please enter email verify"
        },
        status: {
        required: "Please enter status"
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
  