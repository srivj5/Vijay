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
                                $attributes = array('id'=>'category_form','autocomplete'=>"off",'class'=>'form-valide');
                                echo form_open_multipart($action,$attributes);
                                ?>
                                    <!-- <form class="form-valide" action="#" method="post"> -->                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Title <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Arabic Title <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="arabic_title" name="arabic_title" placeholder="Enter a arabic title..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Image <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control" id="image" name="image" placeholder="Upload Image..">
                                            </div>
                                        </div>                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="">Please select</option>
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>        
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
$('#category_form').validate({
        // errorClass: 'invalid-feedback',
        rules: {        
        title: {
        required: true
        },
        arabic_title: {
        required: true
        },
        image: {
        required: true
        },        
        status: {
        required: true
        }
        },
        messages: {        
        title: {
        required: "Please enter title"
        },
        arabic_title: {
        required: "Please enter arabic_title"
        },
        image: {
        required: "Please upload file"
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
  