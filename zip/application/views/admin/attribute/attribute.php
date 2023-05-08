 <?php $this->load->view('admin/header');
?>   
<link href="<?php echo admin_source(); ?>/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Table</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                
                                                <th>S.No</th>
                                                <th>Menu</th>
                                                <th>Attribute</th>
                                                <th>Required Status</th>
                                                <th> Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                         $i=1;
                                        if(count($attribute)!=0)
                                        foreach($attribute as $attr){ ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo getMenu($attr->menu);?></td>
                                                <td><?php echo $attr->attribute ;?></td> 
                                                <td><?php echo ($attr->required_status == 1)?"Required":"Optional" ;?></td>                                               
                                                <td><?php echo ($attr->status == 1)?"Enable":"Disable" ;?></td>
                                                <td><a href="<?php echo admin_url() . 'attribute/add_attribute/' . $attr->id ?>" data-placement="top" data-toggle="popover" data-content="Edit" class="poper"><i class="fa fa-pencil text-primary"></i></a> / 
                                                    <?php if($attr->status == 0){?>
                                                    <a href="<?php echo admin_url() . 'attribute/status_change/' . $attr->id .'/1'?>" data-placement="top" data-toggle="popover" data-content="Status" class="poper"><i class="fa fa-lock text-primary"></i></a><?php } else{ ?> <a href="<?php echo admin_url() . 'attribute/status_change/' . $attr->id .'/0'?>" data-placement="top" data-toggle="popover" data-content="Status" class="poper"><i class="fa fa-unlock text-primary"></i></a> <?php } ?>
                                                </td>


                                            </tr>
                                        </tbody>
                                    <?php $i++; } ?>
                                    </table>
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
    <script src="<?php echo admin_source(); ?>/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo admin_source(); ?>/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo admin_source(); ?>/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>


<script type="text/javascript">

var success = "<?php echo $this->session->flashdata('success')?>";
var error = "<?php echo $this->session->flashdata('error')?>";
if(success!=''){
toastr.success('Classifieds! '+success);
}
if(error!=''){
    toastr.error('Classifieds! '+error);
}
</script>