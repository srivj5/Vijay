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
                                $attributes = array('id'=>'attribute_form','autocomplete'=>"off",'class'=>'form-valide');
                                echo form_open_multipart($action,$attributes);
                                ?>
                                    <!-- <form class="form-valide" action="#" method="post"> -->                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label"> Menu <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="menu" name="menu" >
                                                    <option value="">Please select</option>
                                                    <?php foreach($menus as $menu){?>
                                                    <option <?php if($menu->id==$attribute_rec->menu){echo 'selected';}?> value="<?php echo $attribute_rec->menu;?>"><?php echo getMenu($attribute_rec->menu);?></option> 
                                                    <?php } ?>        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Attribute <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="attribute" name="attribute" value="<?php echo $attribute_rec->attribute;?>" placeholder="Enter a Attribute">
                                            </div>
                                        </div>
<!--                                         <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Image <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control" id="image" value="<?php echo $attribute_rec->image; ?>" name="image" placeholder="Upload Image..">

                                                <?php $im = $attribute_rec->image; ?>
                                                <?php if($attribute_rec->image!='') { ?>
                                                <img src="<?php echo $im; ?>" style="width:65px;height:65px;" />
                                                <?php } ?>


                                            </div>
                                        </div> -->   

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Type <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="type" name="type">
                                                    <option value="">Please select</option>
                                                    <option <?php if($attribute_rec->type=='input'){echo 'selected';}?> value="input">Input</option>

                                                    <option <?php if($attribute_rec->type=='select'){echo 'selected';}?> value="select">Select</option>

                                                    <option <?php if($attribute_rec->type=='checkbox'){echo 'selected';}?> value="checkbox">Checkbox</option>

                                                    <option <?php if($attribute_rec->type=='text'){echo 'selected';}?> value="text">Text</option>

                                                    <option <?php if($attribute_rec->type=='file'){echo 'selected';}?> value="file">File</option>

                                                     <option <?php if($attribute_rec->type=='number'){echo 'selected';}?> value="number">Number</option>

                                                         
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Required Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="required_status" name="required_status">
                                                    <option value="">Please select</option>
                                                    <option <?php if($attribute_rec->required_status==1){echo 'selected';}?> value="1">Required</option>
                                                    <option <?php if($attribute_rec->required_status==0){echo 'selected';}?> value="0">Optional</option>        
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="exist_id" value="<?=$attribute_rec->id;?>">

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="">Please select</option>
                                                    <option <?php if($attribute_rec->status==1){echo 'selected';}?> value="1">Enable</option>
                                                    <option <?php if($attribute_rec->status==0){echo 'selected';}?> value="0">Disable</option>        
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
$('#attribute_form').validate({
        // errorClass: 'invalid-feedback',
        rules: {        
        attribute: {
        required: true
        },
        menu: {
        required: true
        },
        type: {
        required: true
        },
        required_status: {
        required: true
        },
        status: {
        required: true
        }
        },
        messages: {        
        attribute: {
        required: "Please enter attribute Name"
        },
        menu: {
        required: "Please enter Menu"
        },
        type: {
        required: "Please enter type"
        },
        required_status: {
        required: "Please enter Required status"
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
  