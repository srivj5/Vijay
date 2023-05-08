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
                                                <th>Sub Menu</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $i=1;
                                        if(count($menu)!=0)
                                        foreach($menu as $men){ ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo getMenu($men->menu);?></td>
                                                <td><?php echo $men->sub_menu ;?></td>                                                
                                                <td><?php echo ($men->status == 1)?"Enable":"Disable" ;?></td>
                                                <td><a href="<?php echo admin_url() . 'menu/add_Submenu/' . $men->id ?>" data-placement="top" data-toggle="popover" data-content="Edit" class="poper"><i class="fa fa-pencil text-primary"></i></a> / 
                                                    <?php if($men->status == 0){?>
                                                    <a href="<?php echo admin_url() . 'menu/submenu_status_change/' . $men->id .'/1'?>" data-placement="top" data-toggle="popover" data-content="Status" class="poper"><i class="fa fa-lock text-primary"></i></a><?php } else{ ?> <a href="<?php echo admin_url() . 'menu/status_change/' . $men->id .'/0'?>" data-placement="top" data-toggle="popover" data-content="Status" class="poper"><i class="fa fa-unlock text-primary"></i></a> <?php } ?>
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